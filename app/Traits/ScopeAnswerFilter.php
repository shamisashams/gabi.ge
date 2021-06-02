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
use App\Models\Localization;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Lang;

/**
 * Trait ScopeFilter
 * @package App\Traits
 */
trait ScopeAnswerFilter
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
     * @param $title
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
     * @param $type
     * @return mixed
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
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
     * @param $position
     * @return mixed
     */
    public function scopePosition($query, $position)
    {
        return $query->where('position', $position);
    }

    /**
     * @param $query
     * @param $feature
     * @return mixed
     */
    public function scopeFeature($query, $feature)
    {
        $localizationID = Language::getIdByName(app()->getLocale());

        return $query->whereHas('feature.feature', function ($query) use ($localizationID, $feature) {
            $query->where('id', $feature);
        })->whereHas('feature.feature.language', function ($query) use ($localizationID) {
            $query->where('language_id', $localizationID);
        });
    }

}
