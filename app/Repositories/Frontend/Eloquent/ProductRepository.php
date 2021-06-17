<?php

namespace App\Repositories\Frontend\Eloquent;

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

    public function getBestSeller()
    {
        return $this->model::inRandomOrder()
            ->with(['saleProduct.sale', 'availableLanguage', 'files'])
            ->take(10)
            ->get();
    }

    public function getDiscountedProducts()
    {
        return $this->model::with(['saleProduct.sale', 'availableLanguage', 'files'])
            ->has('saleProduct.sale')
            ->take(6)
            ->get();
    }

    public function getNewProducts()
    {
        return $this->model::with(['saleProduct.sale', 'availableLanguage', 'files'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
    }

    public function getProductFilters(int $id, Request $request, $products)
    {
        $productIdArrays = $products->pluck('id')->toArray();
        $filterData = ProductAnswers::with(['feature.availableLanguage', 'feature.answer.availableLanguage'])->whereIn('product_id', $productIdArrays);
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

}
