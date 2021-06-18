<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $products = $this->productRepository->getData($request, ['saleProduct.sale', 'availableLanguage', 'files'], false);
//        $staticFilterData = ['category'];

        return view('pages.product.catalogue', [
            'products' => $products->orderBy('created_at', 'DESC')->paginate(16),
            'productFeatures' => $this->productRepository->getProductFilters($category->id, $request, $products)['productFeatures'],
            'productAnswers' => $this->productRepository->getProductFilters($category->id, $request, $products)['productAnswers'],
//            'staticFilterData' => $staticFilterData,
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
            'productFeatures'=>$this->productRepository->getSingleProductFeatures($id)['productFeatures'],
            'productAnswers'=>$this->productRepository->getSingleProductFeatures($id)['productAnswers'],
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
