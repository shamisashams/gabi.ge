<?php

namespace App\Http\Controllers;

use App\Http\Request\Admin\AnswerRequest;
use App\Mail\ContactEmail;
use App\Models\Answer;
use App\Models\Feature;
use App\Models\Language;
use App\Models\Localization;
use App\Models\Page;
use App\Models\Setting;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\Frontend\CategoryRepositoryInterface;
use App\Repositories\Frontend\ProductRepositoryInterface;
use App\Repositories\Frontend\SliderRepositoryInterface;
use App\Services\AnswerService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $sliderRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository, SliderRepositoryInterface $sliderRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->sliderRepository = $sliderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function index($locale, Request $request)
    {
        $page = Page::query()->where('type','home')->with('availableLanguage')->firstOrFail();

        return view('pages.home.index', [
            'bestSellerProducts' => $this->productRepository->getBestSeller(),
            'discountedProducts' => $this->productRepository->getDiscountedProducts(),
            'newProducts' => $this->productRepository->getNewProducts(),
//            'categories' => $this->categoryRepository->getMainCategories(),
        'page' => $page,
            'sliders' => $this->sliderRepository->getSliders(),
            'banner' => $this->sliderRepository->getBanner()
        ]);
    }

    public function getSingleProductFeaturesApi(string $locale, $id)
    {

        $productFeatures = $this->productRepository->getSingleProductFeatures($id)['productFeatures'];
        $productAnswers = $this->productRepository->getSingleProductFeatures($id)['productAnswers'];
        return response()->json(['status' => true, 'productFeatures' => $productFeatures, 'productAnswers' => $productAnswers]);
    }

}
