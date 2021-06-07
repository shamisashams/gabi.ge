<?php

 namespace App\Repositories\Eloquent;

 use App\Repositories\ProductRepositoryInterface;
 use App\Repositories\Eloquent\Base\BaseRepository;
 use Illuminate\Http\Request;
 use App\Models\Product;
 use App\Traits\RequestFilter;

 class ProductRepository extends BaseRepository implements ProductRepositoryInterface
 {

     use RequestFilter;

     public function __construct(Product $model)
     {
	 parent::__construct($model);
     }

     public function getData($request, $relation = null)
     {
	 $categoryModelQuery = $this->model->query();

	 $categoryModel = $this->setFiltersFromRequest($categoryModelQuery, $request);

	 $perPage = 10;
	 if ($request->filled('per_page')) {
	     $perPage = $request['per_page'];
	 }

	 if ($relation) {
	     return $categoryModel->with($relation)->paginate($perPage);
	 }

	 return $categoryModel->paginate($perPage);
     }

     public function update($id, Request $request)
     {
	 
     }

     public function store(Request $request)
     {
	 
     }

 }
 