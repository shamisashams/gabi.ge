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

     public function getData($request, $relation = null)
     {
         $categoryModelQuery = $this->model->query();

         $categoryModel = $this->setFiltersFromRequest($categoryModelQuery, $request);

         $perPage = 10;
         if ($request->filled('per_page')) {
             $perPage = $request['per_page'];
         }

         if ($relation) {
             return $categoryModel->with($relation)->paginate($perPage);
         }

         return $categoryModel->paginate($perPage);
     }

     public function update(string $lang, int $id, CategoryRequest $request)
     {
         $request['status'] = isset($request['status']) ? 1 : 0;

         try {
             DB::beginTransaction();

             $categoryItem = $this->find($id);

             if (!$categoryItem) {
                 return false;
             }

             $categoryItem->update([
                 'position' => $request['position'],
                 'status' => $request['status'],
                 'parent_id' => $request['parent_id']
             ]);

             $categoryId = $categoryItem->id;

             $currentLanguageId = Language::getIdByName($lang);

             $categoryLanguageItem = CategoryLanguage::where([
                         'category_id' => $categoryId,
                         'language_id' => $currentLanguageId
                     ])->first();

             if (is_null($categoryLanguageItem)) {
                 CategoryLanguage::create([
                     'category_id' => $categoryId,
                     'language_id' => $currentLanguageId,
                     'title' => $request['title'],
                     'description' => $request['description'],
                     'slug' => $request['slug']
                 ]);
             } else {
                 $categoryLanguageItem->update([
                     'title' => $request['title'],
                     'description' => $request['description'],
                     'slug' => $request['slug']
                 ]);
             }


             DB::commit();
             return true;
         } catch (\Exception $queryException) {
             DB::rollBack();
             return false;
         }
     }

     public function store(string $lang, CategoryRequest $request)
     {
         $fields = $request->only([
             'title',
             'slug',
             'description',
             'status',
             'position',
             'parent_id'
         ]);

         $fields['status'] = isset($fields['status']) ? 1 : 0;

         //// Create new item

         try {
             DB::beginTransaction();

             $categoryItem = $this->model->create([
                 'position' => $fields['position'],
                 'status' => $fields['status'],
                 'parent_id' => $fields['parent_id']
             ]);

             $categoryId = $categoryItem->id;

             if (!$categoryId) {
                 return false;
             }

             /// Save with correct language
             $languageId = Language::getIdByName($lang);

             CategoryLanguage::create([
                 'category_id' => $categoryId,
                 'language_id' => $languageId,
                 'title' => $fields['title'],
                 'description' => $fields['description'],
                 'slug' => $fields['slug']
             ]);

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

 }
 