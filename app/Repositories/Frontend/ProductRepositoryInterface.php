<?php

namespace App\Repositories\Frontend;

use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function getBestSeller();

    public function getDiscountedProducts();

    public function getNewProducts();

    public function getProductFilters(int $id, Request $request, $products);

    public function getProductById(int $id);
}
