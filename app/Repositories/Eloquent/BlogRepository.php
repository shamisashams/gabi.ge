<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\BlogRequest;
use App\Http\Request\Admin\SettingRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Models\Blog;
use App\Models\BlogLanguage;
use App\Models\FileLanguage;
use App\Models\Language;
use App\Models\Localization;
use App\Models\Setting;
use App\Models\SettingLanguage;
use App\Models\Slider;
use App\Models\SliderLanguage;
use App\Repositories\BlogRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\SliderRepositoryInterface;
use Gumlet\ImageResize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{

    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    /**
     * Create Feature item into db.
     *
     * @param string $lang
     * @param array $request
     * @return bool
     */
    public function store(string $locale, BlogRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;

        $localizationID = Language::getIdByName($locale);

        //dd($request->all());

        try {
            DB::beginTransaction();
            $this->model = new Blog([
                'status' => $request['status'],

            ]);

            $this->model->save();

            $this->model->language()->create([
                'blog_id' => $this->model->id,
                'language_id' => $localizationID,
                'title' => $request['title'],
                'meta_title' => $request['meta_title'],
                'title_2' => $request['title_2'],
                'text' => $request['text'],
                'text_2' => $request['text_2'],
                'text_3' => $request['text_3'],
                'meta_keywords' => $request['meta_keywords'],
                'slug' => $request['slug'],
                'meta_description' => $request['meta_description'],
            ]);

            $model = $this->model;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $image = new ImageResize($file);
                    $image->resizeToHeight(600);

                    $image->crop(1650, 600, true, ImageResize::CROPCENTER);
                    //$image->save(date('Ymhs') . $file->getClientOriginalName());
                    $img = $image->getImageAsString();

                    $imagename = str_replace(' ','_',$file->getClientOriginalName());
                    $destination = base_path() . '/storage/app/public/blog/' . $this->model->id;
                    $request->file('images')[$key]->move($destination, $imagename);
                    $model->files()->create([
                        'name' => $imagename,
                        'path' => '/storage/app/public/blog/' . $model->id,
                        'format' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $dbException) {
            dd($dbException->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * Update Answer item.
     *
     * @param int $id
     * @param SettingRequest $request
     * @return bool
     */

    public function update(string $locale, int $id, BlogRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;
        $data = $this->find($id);

        //dd($request->all());

        try {
            DB::beginTransaction();
            $data->update([
                'status' => $request['status'],
            ]);

            $localizationID = Language::getIdByName($locale);

            $sliderLanguage = BlogLanguage::where(['blog_id' => $data->id, 'language_id' => $localizationID])->first();
            if ($sliderLanguage == null) {
                $data->language()->create([
                    'blog_id' => $data->id,
                    'language_id' => $localizationID,
                    'title' => $request['title'],
                    'meta_title' => $request['meta_title'],
                    'title_2' => $request['title_2'],
                    'text' => $request['text'],
                    'text_2' => $request['text_2'],
                    'text_3' => $request['text_3'],
                    'meta_keywords' => $request['meta_keywords'],
                    'slug' => $request['slug'],
                    'meta_description' => $request['meta_description'],
                ]);
            } else {
                $sliderLanguage->title = $request['title'];
                $sliderLanguage->meta_title = $request['meta_title'];
                $sliderLanguage->title_2 = $request['title_2'];
                $sliderLanguage->text = $request['text'];
                $sliderLanguage->text_2 = $request['text_2'];
                $sliderLanguage->text_3 = $request['text_3'];
                $sliderLanguage->meta_keywords = $request['meta_keywords'];
                $sliderLanguage->slug = $request['slug'];
                $sliderLanguage->meta_description = $request['meta_description'];
                $sliderLanguage->save();
            }

            if (count($data->files) > 0) {
                foreach ($data->files as $file) {
                    if ($request['old_images'] == null) {
                        if (Storage::exists('public/blog/' . $data->id . '/' . $file->name)) {
                            Storage::delete('public/blog/' . $data->id . '/' . $file->name);
                        }
                        if (Storage::exists('public/blog/' . $data->id . '/thumb/' . $file->name)) {
                            Storage::delete('public/blog/' . $data->id . '/thumb/' . $file->name);
                        }
                        $file->delete();
                        continue;
                    }
                    if (!in_array($file->id, $request['old_images'])) {
                        if (Storage::exists('public/blog/' . $data->id . '/' . $file->name)) {
                            Storage::delete('public/blog/' . $data->id . '/' . $file->name);
                        }
                        if (Storage::exists('public/blog/' . $data->id . '/thumb/' . $file->name)) {
                            Storage::delete('public/blog/' . $data->id . '/thumb/' . $file->name);
                        }
                        $file->delete();

                    }

                    $language = $file->languages()->where('language_id', $localizationID)->first();
                    //dd($language);
                    if ($language) {
                        $language->update([
                            'language_id' => $localizationID,
                            'title' => $request['alt'][$file->id],
                        ]);
                    } else {
                        //dd($file->id);
                        FileLanguage::create([
                            'file_id' => $file->id,
                            'language_id' => $localizationID,
                            'title' => $request['alt'][$file->id],

                        ]);
                    }
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $image = new ImageResize($file);
                    $image->resizeToHeight(600);

                    $image->crop(1650, 600, true, ImageResize::CROPCENTER);
                    //$image->save(date('Ymhs') . $file->getClientOriginalName());
                    $img = $image->getImageAsString();

                    $imagename = str_replace(' ','_',$file->getClientOriginalName());
                    $destination = base_path() . '/storage/app/public/blog/' . $data->id;
                    $thumb = 'public/blog/' . $data->id .'/thumb/'.$imagename;
                    $request->file('images')[$key]->move($destination, $imagename);
                    Storage::put($thumb,$img);
                    $data->files()->create([
                        'name' => $imagename,
                        'path' => '/storage/app/public/blog/' . $data->id,
                        'format' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $dbException) {
            DB::rollBack();
            return false;
        }
    }

    public function delete(int $id)
    {
        $model = $this->find($id);
        foreach ($model->files as $file){

            if (Storage::exists('public/blog/' . $model->id . '/' . $file->name)) {
                Storage::delete('public/blog/' . $model->id . '/' . $file->name);
            }
            if (Storage::exists('public/blog/' . $model->id . '/thumb/' . $file->name)) {
                Storage::delete('public/blog/' . $model->id . '/thumb/' . $file->name);
            }
            $file->delete();
        }
        return $model->delete();
    }

}
