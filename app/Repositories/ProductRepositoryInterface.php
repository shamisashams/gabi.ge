<?php

 namespace App\Repositories;
 
 use Illuminate\Http\Request;

 interface ProductRepositoryInterface
 {

     public function getData(Request $request);

     public function update($id, Request $request);

     public function store(Request $request);
 }
 