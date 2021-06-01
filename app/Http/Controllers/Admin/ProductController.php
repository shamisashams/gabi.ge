<?php

 namespace App\Http\Controllers\Admin;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;

 class ProductController extends AdminController
 {

     public function index(Request $request,$locale)
     {
	 return view('admin.modules.product.index');
     }

     public function store()
     {
	 
     }

     public function create()
     {
	 
     }

     public function show()
     {
	 
     }

     public function edit()
     {
	 
     }

     public function destory()
     {
	 
     }

 }
 