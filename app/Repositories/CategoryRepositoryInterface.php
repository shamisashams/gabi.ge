<?php

 namespace App\Repositories;

 use App\Http\Request\Admin\CategoryRequest;

 interface CategoryRepositoryInterface
 {

     public function update(string $lang, int $id, CategoryRequest $request);

     public function store(string $lang, CategoryRequest $request);

     public function delete($id);
 }
