<?php

namespace App\Repositories\Frontend\Eloquent;

use App\Models\Product;
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


}
