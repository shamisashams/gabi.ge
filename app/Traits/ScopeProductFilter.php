<?php
/**
 *  app/Traits/ScopeFilter.php
 *
 * Date-Time: 19.05.21
 * Time: 10:59
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Traits;


use App\Models\Language;
use App\Models\ProductAnswers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ScopeFilter
 * @package App\Traits
 */
trait ScopeProductFilter
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
        $query->where('price', '>=', intval($price * 100));

    }

    /**
     * @param $query
     * @param $price
     *
     * @return mixed
     */
    public function scopeMaxPrice($query, $price)
    {
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
}
