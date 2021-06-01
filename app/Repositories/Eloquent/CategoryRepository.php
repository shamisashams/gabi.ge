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

     public function getData(Request $request)
     {
	 
     }

     public function update($id, LanguageRequest $request)
     {
	 
     }

     public function store(LanguageRequest $request)
     {
	 
     }

     public function delete($id)
     {
	 
     }

 }
 