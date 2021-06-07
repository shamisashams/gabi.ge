<?php

 namespace App\Http\Controllers\Admin;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use App\Models\Product;
 use App\Repositories\ProductRepositoryInterface;

 class ProductController extends AdminController
 {

     protected $productRepository;

     public function __construct(ProductRepositoryInterface $productRepository)
     {
	 $this->productRepository = $productRepository;
     }

     public function index(Request $request, $locale)
     {
	 $products = $this->productRepository->getData($request, 'availableLanguage');

	 return view('admin.modules.product.index', [
	     'products' => $products
	 ]);
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
 