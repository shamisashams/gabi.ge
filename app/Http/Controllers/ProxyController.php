<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Help;
use App\Models\Language;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductAnswers;
use App\Models\Setting;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Frontend\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Contracts\Console\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Socialite\Contracts\Factory;

class ProxyController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(CategoryRepository $categoryRepository, \App\Repositories\Frontend\Eloquent\ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }


    public function proxy(Request $request){
        $slug = $request->segments();

        array_shift($slug);
        $category_slug = implode('/',$slug);
        //dd($slug);

        $category = Category::query()->whereHas('language',function ($query) use ($category_slug){
            $query->where('slug', $category_slug)->where('language_id', '=', Language::getIdByName(app()->getLocale()));
        })->first();

        $cat_redirect = Setting::query()->where('key','category_not_found_redirect')->first();
        $val = count($cat_redirect->availableLanguage) > 0 ? $cat_redirect->availableLanguage[0]->value : false;
        if((!$category) && $val){
            //return redirect($val,301);
        } elseif (!$category){
            //return abort(404);
        }

        if($category){
            $request->merge([
                'category' => $category->id,
                'sortParams' => ['sort' => 'position', 'order' => 'DESC']
            ]);

            $products = $this->productRepository->getData($request, ['saleProduct.sale', 'availableLanguage', 'availableLanguageS', 'files', 'category.availableLanguageS', 'category.availableLanguage'], false);
//        $staticFilterData = ['category'];
            //dd($products->get());

            return view('pages.product.catalogue', [
                'productFeatures' => $this->productRepository->getProductFilters($request, $products)['productFeatures'],
                'productAnswers' => $this->productRepository->getProductFilters($request, $products)['productAnswers'],
//            'staticFilterData' => $staticFilterData,
                'products' => $products->orderBy('created_at', 'DESC')->paginate(16),
                'category' => $category
            ]);
        }

        $slug = $category_slug;

        $page = Page::where(['status' => true])
            ->whereHas('language',function ($query) use ($slug){
                $query->where('slug',$slug);
            })
            ->with('availableLanguage')
            ->first();

        //dd($page);

        if($page){
            $page_redirect = Setting::query()->where('key','page_not_found_redirect')->first();
            $val = count($page_redirect->availableLanguage) > 0 ? $page_redirect->availableLanguage[0]->value : false;
            if((!$page) && $val){
                //return redirect($val,301);
            } elseif (!$page){
                //return abort(404);
            }

            switch ($page->type){
                case 'blogs':
                    return view('pages.'. $page->type .'.index', [
                        'page' => $page,
                        'blogs' => Blog::with('availableLanguage')->paginate('6')
                    ]);
                    break;
                case 'helps':
                    return view('pages.'. $page->type .'.index', [
                        'page' => $page,
                        'helps' => Help::with('availableLanguage')->get(),
                        'faqs' => Faq::with('availableLanguage')->get()
                    ]);
                    break;
                default:
                    return view('pages.'. $page->type .'.index', [
                        'page' => $page
                    ]);

            }
        }


        abort(404);

    }
}
