<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\SettingRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Models\Language;
use App\Models\Localization;
use App\Models\Setting;
use App\Models\SettingLanguage;
use App\Models\Slider;
use App\Models\SliderLanguage;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\SliderRepositoryInterface;
use Gumlet\ImageResize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{

    public function __construct(Slider $model)
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
    public function store(string $locale, SliderRequest $request)
    {
        // dd($request->post());
        $request['status'] = isset($request['status']) ? 1 : 0;

        $localizationID = Language::getIdByName($locale);

        try {
            DB::beginTransaction();
            $this->model = new Slider([
                'status' => $request['status'],
                'position' => $request['position'],
                'redirect_url' => $request['redirect_url'],
                'type' => $request['type'],
                'h_tag' => $request['h_tag'],
                'is_mobile' => $request['is_mobile'],
            ]);

            $this->model->save();

            $this->model->language()->create([
                'slider_id' => $this->model->id,
                'language_id' => $localizationID,
                'title' => $request['title'],
                'slug' => $request['slug'],
                'description' => $request['description'],
            ]);

            $model = $this->model;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {

                    $image = new ImageResize($file);
                    $image->resizeToHeight(1080);

                    $image->crop(1920, 1080, true, ImageResize::CROPCENTER);
                    //$image->save(date('Ymhs') . $file->getClientOriginalName());
                    $img = $image->getImageAsString();

                    $imagename = str_replace(' ', '_', $file->getClientOriginalName());
                    $destination = base_path() . '/storage/app/public/slider/' . $this->model->id;
                    $thumb = 'public/slider/' . $this->model->id . '/thumb/' . $imagename;
                    $request->file('images')[$key]->move($destination, $imagename);
                    Storage::put($thumb, $img);
                    $model->files()->create([
                        'name' => $imagename,
                        'path' => '/storage/app/public/slider/' . $model->id,
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

    /**
     * Update Answer item.
     *
     * @param int $id
     * @param SettingRequest $request
     * @return bool
     */

    public function update(string $locale, int $id, SliderRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;
        $data = $this->find($id);

        try {
            DB::beginTransaction();
            $data->update([
                'position' => $request['position'],
                'status' => $request['status'],
                'redirect_url' => $request['redirect_url'],
                'type' => $request['type'],
                'h_tag' => $request['h_tag'],
                'is_mobile' => $request['is_mobile'],
            ]);

            $localizationID = Language::getIdByName($locale);

            $sliderLanguage = SliderLanguage::where(['slider_id' => $data->id, 'language_id' => $localizationID])->first();
            if ($sliderLanguage == null) {
                $data->language()->create([
                    'slider_id' => $data->id,
                    'language_id' => $localizationID,
                    'title' => $request['title'],
                    'slug' => $request['slug'],
                    'description' => $request['description'],
                ]);
            } else {
                $sliderLanguage->title = $request['title'];
                $sliderLanguage->slug = $request['slug'];
                $sliderLanguage->description = $request['description'];
                $sliderLanguage->save();
            }

            if (count($data->files) > 0) {
                foreach ($data->files as $file) {
                    if ($request['old_images'] == null) {
                        if (Storage::exists('public/slider/' . $data->id . '/' . $file->name)) {
                            Storage::delete('public/slider/' . $data->id . '/' . $file->name);
                        }
                        if (Storage::exists('public/slider/' . $data->id . '/thumb/' . $file->name)) {
                            Storage::delete('public/slider/' . $data->id . '/thumb/' . $file->name);
                        }
                        $file->delete();
                        continue;
                    }
                    if (!in_array($file->id, $request['old_images'])) {
                        if (Storage::exists('public/slider/' . $data->id . '/' . $file->name)) {
                            Storage::delete('public/slider/' . $data->id . '/' . $file->name);
                        }
                        if (Storage::exists('public/slider/' . $data->id . '/thumb/' . $file->name)) {
                            Storage::delete('public/slider/' . $data->id . '/thumb/' . $file->name);
                        }
                        $file->delete();
                    }
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $image = new ImageResize($file);
                    $image->resizeToHeight(1080);

                    $image->crop(1920, 1080, true, ImageResize::CROPCENTER);
                    //$image->save(date('Ymhs') . $file->getClientOriginalName());
                    $img = $image->getImageAsString();

                    $imagename = str_replace(' ', '_', $file->getClientOriginalName());
                    $destination = base_path() . '/storage/app/public/slider/' . $data->id;
                    $thumb = 'public/slider/' . $data->id . '/thumb/' . $imagename;
                    $request->file('images')[$key]->move($destination, $imagename);
                    Storage::put($thumb, $img);
                    $data->files()->create([
                        'name' => $imagename,
                        'path' => '/storage/app/public/slider/' . $data->id,
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
        foreach ($model->files as $file) {

            if (Storage::exists('public/slider/' . $model->id . '/' . $file->name)) {
                Storage::delete('public/slider/' . $model->id . '/' . $file->name);
            }
            if (Storage::exists('public/slider/' . $model->id . '/thumb/' . $file->name)) {
                Storage::delete('public/slider/' . $model->id . '/thumb/' . $file->name);
            }
            $file->delete();
        }
        return $model->delete();
    }
}
