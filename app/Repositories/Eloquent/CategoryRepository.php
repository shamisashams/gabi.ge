<?php

 namespace App\Repositories\Eloquent;

 use Illuminate\Support\Facades\DB;
 use App\Models\Language;
 use App\Models\Category;
 use App\Repositories\Eloquent\Base\BaseRepository;
 use App\Repositories\CategoryRepositoryInterface;
 use App\Http\Request\Admin\CategoryRequest;
 use App\Models\CategoryLanguage;
 use Illuminate\Database\Eloquent\Builder;
 use Illuminate\Http\Request;

 /**
  * Description of CategoryRepository
  *
  * @author root
  */
 class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
 {

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

     protected function setFiltersFromRequest(Builder $modelQueryBuilder, Request $request)
     {
	 if ($request['id']) {
	     $modelQueryBuilder->where('id', '=', (int) $request['id']);
	 }

	 if (false === is_null($request['status'])) {
	     $modelQueryBuilder->where('status', '=', (int) $request['status']);
	 }

	 if ($request['title']) {
	     $modelQueryBuilder->whereHas('availableLanguage', function ($query) use ($request) {
		 $query->where('title', 'like', "%{$request['title']}%");
	     });
	 }

	 if ($request['slug']) {
	     $modelQueryBuilder->whereHas('availableLanguage', function ($query) use ($request) {
		 $query->where('slug', 'like', "%{$request['slug']}%");
	     });
	 }

	 if ($request['description']) {
	     $modelQueryBuilder->whereHas('availableLanguage', function ($query) use ($request) {
		 $query->where('description', 'like', "%{$request['description']}%");
	     });
	 }

	 return $modelQueryBuilder;
     }

 }
 