<?php

 namespace App\Repositories;

 use App\Http\Request\Admin\CategoryRequest;
 

 interface CategoryRepositoryInterface
 {

     public function getData(CategoryRequest $request);

     public function update($id, CategoryRequest $request);

     public function store(CategoryRequest $request);

     public function delete($id);
 }
 