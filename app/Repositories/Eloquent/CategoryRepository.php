<?php

 /*
  * To change this license header, choose License Headers in Project Properties.
  * To change this template file, choose Tools | Templates
  * and open the template in the editor.
  */

 namespace App\Repositories\Eloquent;

 use App\Models\Category;
 use App\Repositories\Eloquent\Base\BaseRepository;
 use App\Repositories\CategoryRepositoryInterface;
 use App\Http\Request\Admin\CategoryRequest;

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

     public function store(CategoryRequest $request)
     {
	 
     }

     public function delete($id)
     {
	 
     }

 }
 