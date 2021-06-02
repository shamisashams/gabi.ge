<?php

 /*
  * To change this license header, choose License Headers in Project Properties.
  * To change this template file, choose Tools | Templates
  * and open the template in the editor.
  */

 namespace App\Repositories\Eloquent;

 use Illuminate\Support\Facades\DB;
 use App\Models\Language;
 use App\Models\Category;
 use App\Repositories\Eloquent\Base\BaseRepository;
 use App\Repositories\CategoryRepositoryInterface;
 use App\Http\Request\Admin\CategoryRequest;
 use App\Models\CategoryLanguage;

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

     public function update($id, CategoryRequest $request)
     {
	 
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
	 
     }

 }
 