<?php

 namespace App\Repositories;

 use Illuminate\Http\Request;
 use App\Http\Request\Admin\ProductRequest;

 interface ProductRepositoryInterface
 {

     public function getData(Request $request);

     public function update(string $lang, int $id, ProductRequest $request);

     public function store(string $lang, ProductRequest $request);
 }
 