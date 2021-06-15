<?php

namespace App\Repositories\Frontend;

use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function getBestSeller();

    public function getDiscountedProducts();

    public function getNewProducts();

}
