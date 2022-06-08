<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductAnswers;
use App\Models\Setting;
use App\Repositories\Frontend\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Contracts\Console\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Socialite\Contracts\Factory;

class ProxyController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function proxy(Request $request){
        echo dd(trim($request->getPathInfo(), '/'));
    }
}
