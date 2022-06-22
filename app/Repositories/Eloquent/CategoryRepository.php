<?php

namespace App\Repositories\Eloquent;

use App\Models\FileLanguage;
use Gumlet\ImageResize;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use App\Models\Category;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Http\Request\Admin\CategoryRequest;
use App\Models\CategoryLanguage;
use App\Traits\RequestFilter;
use Illuminate\Support\Facades\Storage;

/**
 * Description of CategoryRepository
 *
 * @author root
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    use RequestFilter;

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function update(string $lang, int $id, CategoryRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;

        try {
            DB::beginTransaction();

            $categoryItem = $this->find($id);


            $categoryItem->update([
                'position' => $request['position'],
                'status' => $request['status'],
                'h_tag' => $request['h_tag'],
            ]);

            $categoryId = $categoryItem->id;

            $languageId = Language::getIdByName($lang);

            $language = $categoryItem->language()->where('language_id', $languageId)->first();

            if (!$language) {
                CategoryLanguage::create([
                    'category_id' => $categoryId,
                    'language_id' => $languageId,
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'meta_description' => $request['meta_description'],
                    'meta_title' => $request['meta_title'],
                    'meta_keyword' => $request['meta_keyword'],
                    'slug' => $request['slug']
                ]);
            } else {
                $language->update([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'meta_description' => $request['meta_description'],
                    'meta_title' => $request['meta_title'],
                    'meta_keyword' => $request['meta_keyword'],
                    'slug' => $request['slug']
                ]);
            }

            $this->updateImages($request, $categoryItem, $lang);

            DB::commit();
            return true;
        } catch (\Exception $queryException) {
            DB::rollBack();
            return false;
        }
    }

    public function store(string $lang, CategoryRequest $request)
    {

        $request['status'] = isset($request['status']) ? 1 : 0;

        //// Create new item

        try {
            DB::beginTransaction();

            $categoryItem = $this->model->create([
                'position' => $request['position'],
                'status' => $request['status'],
            ]);

            /// Save with correct language
            $languageId = Language::getIdByName($lang);

            CategoryLanguage::create([
                'category_id' => $categoryItem->id,
                'language_id' => $languageId,
                'title' => $request['title'],
                'description' => $request['description'],
                'meta_description' => $request['meta_description'],
                'meta_title' => $request['meta_title'],
                'meta_keyword' => $request['meta_keyword'],
                'slug' => $request['slug']
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $image = new ImageResize($file);
                    $image->resizeToHeight(480);

                    $image->crop(720, 480, true, ImageResize::CROPCENTER);
                    //$image->save(date('Ymhs') . $file->getClientOriginalName());
                    $img = $image->getImageAsString();

                    $imagename = str_replace(' ','_',$file->getClientOriginalName());
                    $destination = base_path() . '/storage/app/public/category/' . $categoryItem->id;
                    $thumb = 'public/category/' . $this->model->id .'/thumb/'.$imagename;
                    $request->file('images')[$key]->move($destination, $imagename);
                    Storage::put($thumb,$img);
                    $categoryItem->files()->create([
                        'name' => $imagename,
                        'path' => '/storage/app/public/category/' . $categoryItem->id,
                        'format' => $file->getClientOriginalExtension(),
                    ]);
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $queryException) {
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {

        $model = $this->find($id);
        foreach ($model->files as $file){

            if (Storage::exists('public/category/' . $model->id . '/' . $file->name)) {
                Storage::delete('public/category/' . $model->id . '/' . $file->name);
            }
            if (Storage::exists('public/category/' . $model->id . '/thumb/' . $file->name)) {
                Storage::delete('public/category/' . $model->id . '/thumb/' . $file->name);
            }
            $file->delete();
        }
        return $model->delete();
    }


    public function updateImages($request, $model, $lang)
    {
        $languageId = Language::getIdByName($lang);

        if (count($model->files) > 0) {
            foreach ($model->files as $file) {
                if ($request['old_images'] == null) {
                    if (Storage::exists('public/category/' . $model->id . '/' . $file->name)) {
                        Storage::delete('public/category/' . $model->id . '/' . $file->name);
                    }
                    if (Storage::exists('public/category/' . $model->id . '/thumb/' . $file->name)) {
                        Storage::delete('public/category/' . $model->id . '/thumb/' . $file->name);
                    }
                    $file->delete();
                    continue;
                }
                if (!in_array($file->id, $request['old_images'])) {
                    if (Storage::exists('public/category/' . $model->id . '/' . $file->name)) {
                        Storage::delete('public/category/' . $model->id . '/' . $file->name);
                    }
                    if (Storage::exists('public/category/' . $model->id . '/thumb/' . $file->name)) {
                        Storage::delete('public/category/' . $model->id . '/thumb/' . $file->name);
                    }
                    $file->delete();

                }

                $language = $file->languages()->where('language_id', $languageId)->first();
                //dd($language);
                if ($language) {
                    $language->update([
                        'language_id' => $languageId,
                        'title' => $request['alt'][$file->id],
                    ]);
                } else {
                    //dd($file->id);
                    FileLanguage::create([
                        'file_id' => $file->id,
                        'language_id' => $languageId,
                        'title' => $request['alt'][$file->id],

                    ]);
                }
            }
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $image = new ImageResize($file);
                $image->resizeToHeight(480);

                $image->crop(720, 480, true, ImageResize::CROPCENTER);
                //$image->save(date('Ymhs') . $file->getClientOriginalName());
                $img = $image->getImageAsString();

                $imagename = str_replace(' ','_',$file->getClientOriginalName());
                $destination = base_path() . '/storage/app/public/category/' . $model->id;
                $thumb = 'public/category/' . $model->id .'/thumb/'.$imagename;
                $request->file('images')[$key]->move($destination, $imagename);
                Storage::put($thumb,$img);
                $model->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public/category/' . $model->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

    }

}
