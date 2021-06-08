<?php

 namespace App\Repositories\Eloquent;

 use App\Repositories\ProductRepositoryInterface;
 use App\Repositories\Eloquent\Base\BaseRepository;
 use Illuminate\Http\Request;
 use App\Models\Product;
 use App\Traits\RequestFilter;
 use App\Http\Request\Admin\ProductRequest;
 use Illuminate\Support\Facades\DB;
 use App\Models\ProductLanguage;
 use App\Models\Language;

 class ProductRepository extends BaseRepository implements ProductRepositoryInterface
 {

     use RequestFilter;

     public function __construct(Product $model)
     {
	 parent::__construct($model);
     }

     public function getData($request, $relation = null)
     {
	 $productModelQuery = $this->model->query();

	 $productModel = $this->setFiltersFromRequest($productModelQuery, $request);

	 $perPage = 10;

	 if ($request->filled('per_page')) {
	     $perPage = $request['per_page'];
	 }

	 if ($relation) {
	     return $productModel->with($relation)->paginate($perPage);
	 }

	 return $productModel->paginate($perPage);
     }

     public function update(string $lang, int $id, ProductRequest $request)
     {


	 $request['status'] = isset($request['status']) ? 1 : 0;

	 try {
	     DB::beginTransaction();

	     $productItem = $this->find($id);

	     if (!$productItem) {
		 return false;
	     }

	     $productItem->update([
		 'position' => $request['position'],
		 'status' => $request['status'],
		 'category_id' => $request['category_id'],
		 'price' => $request['price']
	     ]);

	     $productId = $productItem->id;

	     $currentLanguageId = Language::getIdByName($lang);

	     $productLanguageItem = ProductLanguage::where([
			 'product_id' => $productId,
			 'language_id' => $currentLanguageId
		     ])->first();

	     if (is_null($productLanguageItem)) {
		 ProductLanguage::create([
		     'product_id' => $productId,
		     'language_id' => $currentLanguageId,
		     'title' => $request['title'],
		     'description' => $request['description'],
		     'short_description' => $request['short_description'],
		     'slug' => $request['slug']
		 ]);
	     } else {
		 $productLanguageItem->update([
		     'title' => $request['title'],
		     'description' => $request['description'],
		     'short_description' => $request['short_description'],
		     'slug' => $request['slug']
		 ]);
	     }

	     DB::commit();
	     return true;
	 } catch (\Exception $queryException) {
	     DB::rollBack();
	     return false;
	 }
     }

     public function store(string $lang, ProductRequest $request)
     {
	 $fields = $request->only([
	     'product_id',
	     'price',
	     'title',
	     'slug',
	     'description',
	     'status',
	     'position',
	     'short_description',
	     'category_id'
	 ]);

	 $fields['status'] = isset($fields['status']) ? 1 : 0;
	 //// Create new item

	 try {
	     DB::beginTransaction();
	     $productItem = $this->model->create([
		 'position' => $fields['position'],
		 'status' => $fields['status'],
		 'category_id' => $fields['category_id'],
		 'price' => $fields['price']
	     ]);

	     $productId = $productItem->id;

	     if (!$productId) {
		 return false;
	     }

	     /// Save with correct language
	     $languageId = Language::getIdByName($lang);

	     ProductLanguage::create([
		 'product_id' => $productId,
		 'language_id' => $languageId,
		 'title' => $fields['title'],
		 'description' => $fields['description'],
		 'slug' => $fields['slug'],
		 'short_description' => $fields['short_description']
	     ]);

	     DB::commit();

	     return true;
	 } catch (\Exception $queryException) {
	     DB::rollBack();
	     return false;
	 }
     }

     public function delete(int $id)
     {
	 return $this->find($id)->delete();
     }

 }
 