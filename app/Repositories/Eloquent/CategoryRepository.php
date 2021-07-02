<?php

namespace App\Repositories\Eloquent;

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
                    'slug' => $request['slug']
                ]);
            } else {
                $language->update([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'slug' => $request['slug']
                ]);
            }

            $this->updateImages($request, $categoryItem);

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
                'slug' => $request['slug']
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $imagename = date('Ymhs') . $file->getClientOriginalName();
                    $destination = base_path() . '/storage/app/public/category/' . $categoryItem->id;
                    $request->file('images')[$key]->move($destination, $imagename);
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
        return $this->find($id)->delete();
    }


    public function updateImages($request, $model)
    {
        if (count($model->files) > 0) {
            foreach ($model->files as $file) {
                if ($request['old_images'] == null) {
                    if (Storage::exists('public/category/' . $model->id . '/' . $file->name)) {
                        Storage::delete('public/category/' . $model->id . '/' . $file->name);
                    }
                    $file->delete();
                    continue;
                }
                if (!in_array($file->id, $request['old_images'])) {
                    if (Storage::exists('public/category/' . $model->id . '/' . $file->name)) {
                        Storage::delete('public/category/' . $model->id . '/' . $file->name);
                    }
                    $file->delete();

                }
            }
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . $file->getClientOriginalName();
                $destination = base_path() . '/storage/app/public/category/' . $model->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $model->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public/category/' . $model->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

    }

}
