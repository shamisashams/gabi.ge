<?php

 namespace App\Http\Controllers\Admin;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use App\Models\Product;
 use App\Http\Request\Admin\ProductRequest;
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

     public function store(string $lang, ProductRequest $request)
     {
	 if (false === $this->productRepository->store($lang, $request)) {
	     return redirect(route('productCreateView', $lang))->with('danger', __('admin.product_not_created'));
	 }

	 return redirect(route('productIndex', $lang))->with('success', __('admin.product_created_succesfully'));
     }

     public function create()
     {
	 return view('admin.modules.product.create');
     }

     public function show(string $lang, int $id)
     {

	 return view('admin.modules.product.view', [
	     'productItem' => $this->productRepository->find($id)
	 ]);
     }

     public function edit()
     {
	 
     }

     public function destroy(string $lang, int $id)
     {
	 if (false === $this->productRepository->delete($id)) {
	     return redirect(route('productIndex', $lang))->with('danger', __('admin.product_not_deleted'));
	 }
	 return redirect(route('productIndex', $lang))->with('success', __('admin.product_deleted_succesfully'));
     }

 }
 