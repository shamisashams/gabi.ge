<?php

 namespace App\Repositories\Eloquent;

 use App\Repositories\ProductRepositoryInterface;
 use App\Repositories\Eloquent\Base\BaseRepository;
 use Illuminate\Http\Request;

 class ProductRepository extends BaseRepository implements ProductRepositoryInterface
 {

     public function __construct(Product $model)
     {
	 parent::__construct($model);
     }

     public function getData(Request $request)
     {
	 
     }

     public function update($id, Request $request)
     {
	 
     }

     public function store(Request $request)
     {
	 
     }

     public function delete($id)
     {
	 
     }

 }
 