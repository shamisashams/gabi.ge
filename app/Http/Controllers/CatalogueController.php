<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductAnswers;
use App\Repositories\Frontend\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Contracts\Console\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Socialite\Contracts\Factory;

class CatalogueController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     * @param Request $request
     * @param Category $category
     *
     * @return Application|Factory|View
     */
    public function catalogue(string $lang, Request $request, Category $category)
    {
        $request->merge([
            'category' => $category->id,
            'sortParams' => ['sort' => 'position', 'order' => 'DESC']
        ]);

        $products = $this->productRepository->getData($request, ['saleProduct.sale', 'availableLanguage', 'availableLanguageS', 'files', 'category.availableLanguageS'], false);
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

    public function catalogueSeo(string $lang, Request $request, $category_slug)
    {
        $category = Category::query()->whereHas('language',function ($query) use ($category_slug){
            $query->where('slug', $category_slug)->where('language_id', '=', Language::getIdByName(app()->getLocale()));
        })->firstOrFail();
        $request->merge([
            'category' => $category->id,
            'sortParams' => ['sort' => 'position', 'order' => 'DESC']
        ]);

        $products = $this->productRepository->getData($request, ['saleProduct.sale', 'availableLanguage', 'availableLanguageS', 'files', 'category.availableLanguageS', "category.availableLanguage"], false);
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

    /**
     * Display the specified resource.
     *
     * @param string $locale
     * @param Category $category
     * @param Product $product
     *
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, Category $category, int $id)
    {
        return view('pages.product.details', [
            'product' => $this->productRepository->getProductById($id),
            'category' => $category,
            'productFeatures' => $this->productRepository->getSingleProductFeatures($id)['productFeatures'],
            'productAnswers' => $this->productRepository->getSingleProductFeatures($id)['productAnswers'],
            'bestSellerProducts' => $this->productRepository->getNewProducts(),
        ]);
    }

    public function showSeo(string $locale, $category_slug = null, $product_slug = null)
    {
        $product = $this->productRepository->getProductByslug($product_slug);
        $category = Category::query()->whereHas('language',function ($query) use ($category_slug){
            $query->where('slug', $category_slug)->where('language_id', '=', Language::getIdByName(app()->getLocale()));
        })->firstOrFail();
        //dd($category);
        return view('pages.product.details', [
            'product' => $product,
            'category' => $category,
            'productFeatures' => $this->productRepository->getSingleProductFeatures($product->id)['productFeatures'],
            'productAnswers' => $this->productRepository->getSingleProductFeatures($product->id)['productAnswers'],
            'bestSellerProducts' => $this->productRepository->getNewProducts(),
        ]);
    }

    protected function getFilters($data): array
    {
        $productIdArrays = $data->orderBy('id', 'DESC')->get()->pluck('id')->toArray();

        $filterData = ProductAnswers::with('feature')->whereIn('product_id', $productIdArrays);
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
}
