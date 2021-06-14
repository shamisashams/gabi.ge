<?php

 namespace App\Http\Controllers\Admin;

 use Illuminate\Http\Request;
 use App\Http\Request\Admin\ProductRequest;
 use App\Repositories\ProductRepositoryInterface;
 use App\Models\Category;
 use App\Models\Feature;
 use App\Models\Sale;

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
         return view('admin.modules.product.create', [
             'categories' => Category::with('availableLanguage')->where('status', '=', '1')->get(),
             'features' => Feature::with('availableLanguage')->where('status', '=', '1')->get(),
             'sales' => Sale::with('availableLanguage')->get()
         ]);
     }

     public function show(string $lang, int $id)
     {

         return view('admin.modules.product.view', [
             'productItem' => $this->productRepository->find($id)
         ]);
     }

     public function edit(string $lang, int $id)
     {
         return view('admin.modules.product.update', [
             'productItem' => $this->productRepository->find($id),
             'categories' => Category::with('availableLanguage')->where('status', '=', '1')->get()
         ]);
     }

     public function update(string $lang, int $id, ProductRequest $request)
     {
         if (false === $this->productRepository->update($lang, $id, $request)) {
             return redirect(route('productEditView', $lang))->with('danger', __('admin.product_not_updated'));
         }

         return redirect(route('productIndex', $lang))->with('success', __('admin.product_updated_succesfully'));
     }

     public function destroy(string $lang, int $id)
     {
         if (false === $this->productRepository->delete($id)) {
             return redirect(route('productIndex', $lang))->with('danger', __('admin.product_not_deleted'));
         }
         return redirect(route('productIndex', $lang))->with('success', __('admin.product_deleted_succesfully'));
     }

     public function getFeatureAnswers(string $locale, int $id)
     {
         $feature = Feature::with('answers')->find($id);

         if (is_null($feature)) {
             return response()->json([]);
         }

         $answerStack = [];

         foreach ($feature->answers as $answerItem) {
             $answerData = $answerItem->answer->availableLanguage;

             if (!count($answerData)) {
                 continue;
             }

             $answerStack[] = [
                 'answer_id' => $answerData[0]->id,
                 'answer_title' => $answerData[0]->title
             ];
         }
         return response()->json($answerStack);
     }

 }
 