<?php

 namespace App\Repositories;

 interface CategoryRepositoryInterface
 {

     public function getData(Request $request);

     public function update($id, LanguageRequest $request);

     public function store(LanguageRequest $request);

     public function delete($id);
 }
 