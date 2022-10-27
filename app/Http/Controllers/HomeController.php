<?php

namespace App\Http\Controllers;

use App\Http\Request\Admin\AnswerRequest;
use App\Mail\ContactEmail;
use App\Models\Answer;
use App\Models\Slider;
use App\Models\Blog;
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
// use Jenssegers\Agent\Facades\Agent;
use Jenssegers\Agent\Agent;

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
        $page = Page::query()->where('type', 'home')->with('availableLanguage')->firstOrFail();
        $agent = new Agent();
        return view('pages.home.index', [
            'agent' => $agent,
            'bestSellerProducts' => $this->productRepository->getBestSeller(),
            'discountedProducts' => $this->productRepository->getDiscountedProducts(),
            'newProducts' => $this->productRepository->getNewProducts(),
            'blogs' => Blog::orderBy('id', 'desc')->with(['availableLanguage', 'firstImage'])->limit(3)->get(),
            'page' => $page,
            // 'sliders' => $this->sliderRepository->getSliders(),
            'sliders' => Slider::with('files')->where("is_mobile", false)->get(),
            'slidersMobile' => Slider::with('files')->where("is_mobile", true)->get(),
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
