<?php
/**
 *  app/Traits/ScopeFilter.php
 *
 * Date-Time: 19.05.21
 * Time: 10:59
 * @author Insite International <hello@insite.international>
 */

namespace App\Traits;


use App\Models\Language;
use App\Models\Product;
use App\Models\ProductAnswers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ScopeFilter
 * @package App\Traits
 */
trait ScopeBlogFilter
{

    /**
     * @param  $request
     * @return Builder
     */
    public function filter($request): Builder
    {
        $data = $this->query();
        $filterScopes = $this->getFilterScopes();
        foreach ($this->getActiveFilters($request) as $filter => $value) {
            if (!array_key_exists($filter, $filterScopes)) {
                continue;
            }
            $filterScopeData = $filterScopes[$filter];

            if (false === $filterScopeData['hasParam']) {
                $data->{$value}();
                continue;
            }
            $methodToExecute = $filterScopeData['scopeMethod'];
            $data->{$methodToExecute}($value);
        }

        $sortParams = ['sort' => 'id', 'order' => 'desc'];

        if ($request->filled('sort') && $request->filled('order')) {
            $sortParams = $request->only('sort', 'order');
        }

        return $data->sorted($sortParams);
    }

    /**
     * @param  $request
     * @return array
     */
    public function getActiveFilters($request): array
    {
        $activeFilters = [];
        foreach ($this->getFilterScopes() as $key => $value) {
            if ($request->filled($key)) {
                $activeFilters [$key] = $request->{$key};
            }
        }
        return $activeFilters;
    }

    /**
     * @param $query
     * @param array $sortParams
     * @return mixed
     */
    public function scopeSorted($query, array $sortParams)
    {
        return $query->orderBy($sortParams['sort'], $sortParams['order']);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }


    /**
     * @param $query
     * @param $price
     *
     * @return mixed
     */
    public function scopeMinPrice($query, $price)
    {
//        Product::calculatePrice()
//        $products = $query->with('saleProduct.sale.availableLanguage')->get();;
//        $arr = [];
//        foreach ($products as $product) {
//            if ($product->saleProduct && $product->saleProduct->sale) {
//                $discountPrice = Product::calculatePrice($product->price, $product->saleProduct->sale->discount, $product->saleProduct->sale->type);
//                if ($discountPrice >= intval($price)) {
//                    $arr[] = $product->id;
//                }
//            } elseif ($product->price >= intval($price * 100)) {
//                $arr[] = $product->id;
//            }
//        }
//        return $query->whereIn('id', $arr);
        return $query->where('price', '>=', intval($price * 100));


    }

    /**
     * @param $query
     * @param $price
     *
     * @return mixed
     */
    public function scopeMaxPrice($query, $price)
    {
//        $products = $query->with('saleProduct.sale.availableLanguage')->get();;
//        $arr = [];
//        foreach ($products as $product) {
//            if ($product->saleProduct && $product->saleProduct->sale) {
//                $discountPrice = Product::calculatePrice($product->price, $product->saleProduct->sale->discount, $product->saleProduct->sale->type);
//                if ($discountPrice <= intval($price)) {
//                    $arr[] = $product->id;
//                }
//            } elseif ($product->price <= intval($price * 100)) {
//                $arr[] = $product->id;
//            }
//        }
//        return $query->whereIn('id', $arr);
        return $query->where('price', '<=', intval($price * 100));

    }


    /**
     * @param $query
     * @param $id
     *
     * @return mixed
     */
    public function scopeCategoryId($query, $id)
    {
        return $query->where(['category_id' => $id]);
    }


    /**
     * @param $query
     * @param $features
     *
     * @return mixed
     */
    public function scopeFeature($query, $features)
    {
        $data = [];
        foreach ($features as $feature) {
            if (gettype($feature) === 'array') {
                $feature = array_map('intval', $feature);
                $data[] = ProductAnswers::orWhereIn('answer_id', $feature)->groupBy('product_id')->get()->pluck('product_id')->toArray();
            } else {
                $data[] = ProductAnswers::orWhere('answer_id', $feature)->groupBy('product_id')->get()->pluck('product_id')->toArray();
            }
        }
        $idsArray = [];


        foreach ($data as $key => $item) {
            if ($key === 0) {
                $idsArray = $item;
                continue;
            }
            $idsArray = array_intersect($idsArray, $item);
        }
        return $query->whereIn('id', $idsArray);

    }

    /**
     * @param $query
     * @param $title
     *
     * @return mixed
     */
    public function scopeTitle($query, $title)
    {
        $localizationID = Language::getIdByName(app()->getLocale());

        return $query->whereHas('language', function ($query) use ($localizationID, $title) {
            $query->where('title', 'like', "%{$title}%")->where('language_id', $localizationID);
        });
    }

    /**
     * @param $query
     * @param $description
     *
     * @return mixed
     */
    public function scopeDescription($query, $description)
    {
        $localizationID = Language::getIdByName(app()->getLocale());

        return $query->whereHas('language', function ($query) use ($localizationID, $description) {
            $query->where('description', 'like', "%{$description}%")->where('language_id', $localizationID);
        });
    }

    /**
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
