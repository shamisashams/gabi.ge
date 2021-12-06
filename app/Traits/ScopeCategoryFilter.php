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
trait ScopeCategoryFilter
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

    /**
     * @param $query
     * @param $slug
     *
     * @return mixed
     */
    public function scopeSlug($query, $slug)
    {
        $localizationID = Language::getIdByName(app()->getLocale());

        return $query->whereHas('language', function ($query) use ($localizationID, $slug) {
            $query->where('slug', 'like', "%{$slug}%")->where('language_id', $localizationID);
        });
    }
}
