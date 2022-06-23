<?php

namespace App\Repositories\Frontend\Eloquent;

use App\Models\Language;
use App\Models\Product;
use App\Models\ProductAnswers;
use App\Models\ProductFeatures;
use App\Repositories\Frontend\Eloquent\Base\BaseRepository;
use App\Repositories\Frontend\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getBestSeller($id = null)
    {
         $q = $this->model::inRandomOrder()
            ->with(['saleProduct.sale', 'availableLanguage', 'availableLanguageS', 'files','category.availableLanguage','category.availableLanguageS'])
            ->whereHas('language',function ($query){
                $query->where('slug','!=',null);
            })
            ->whereHas('category.language',function ($query){
                $query->where('slug','!=',null);
            })
            ->where('best_seller',1);

         if($id !== null){
            $q->where('id','!=',$id);
         }
        return $q->take(10)->get();
    }


    public function getAll(Request $request, $discount = false, $new = false){
        $data = $this->model->filter($request);

        $data->with(['saleProduct.sale', 'availableLanguage', 'availableLanguageS', 'files', 'category.availableLanguageS', 'category.availableLanguage']);

        if($discount){
            $data->has('saleProduct.sale');
        }
        if($new){
            $data->orderBy('created_at', 'desc');
        }


        return $data;
    }

    public function getDiscountedProducts()
    {
        return $this->model::with(['saleProduct.sale', 'availableLanguage', 'availableLanguageS', 'files','category.availableLanguage', 'category.availableLanguageS'])
            ->has('saleProduct.sale')
            ->take(6)
            ->get();
    }

    public function getNewProducts()
    {
        return $this->model::with(['saleProduct.sale', 'availableLanguage', 'availableLanguageS', 'files','category.availableLanguage', 'category.availableLanguageS'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
    }

    public function getProductFilters(Request $request, $products)
    {
        $productIdArrays = $products->pluck('id')->toArray();
        $filterData = ProductAnswers::with(['feature.availableLanguage', 'feature.answer.availableLanguage']);
        $productFeatures = $filterData
            ->groupBy('feature_id')
            ->get()
            ->sortBy(function ($query) {
                return $query->feature->position;
            });


        $productAnswers = $filterData->groupBy('answer_id')->get()->pluck('answer_id')->toArray();

        return [
            'productFeatures' => $productFeatures,
            'productAnswers' => $productAnswers
        ];
    }

    public function getSingleProductFeatures($id)
    {
        $filterData = ProductAnswers::with(['feature.availableLanguage', 'feature.answer.availableLanguage','feature.englishLanguage'])->where('product_id', $id);
        $productFeatures = $filterData
            ->groupBy('feature_id')
            ->get()
            ->sortBy(function ($query) {
                return $query->feature->position;
            });


        $productAnswers = $filterData->groupBy('answer_id')->get()->pluck('answer_id')->toArray();

        return [
            'productFeatures' => $productFeatures,
            'productAnswers' => $productAnswers
        ];
    }

    public function getProductById(int $id)
    {
        return $this->model::where(['id' => $id])->with(['availableLanguage', 'files', 'saleProduct.sale'])->first();
    }

    public function getProductBySlug($slug)
    {

        $localizationID = Language::getIdByName(app()->getLocale());

        return $this->model::query()->whereHas('language',function ($query) use ($slug, $localizationID){
            $query->where('slug', $slug)->where('language_id', $localizationID);
        })->with(['availableLanguage', 'files', 'saleProduct.sale'])->first();
    }

}
