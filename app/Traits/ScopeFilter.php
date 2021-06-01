<?php
/**
 *  app/Traits/ScopeFilter.php
 *
 * Date-Time: 19.05.21
 * Time: 10:59
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ScopeFilter
 * @package App\Traits
 */
trait ScopeFilter
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
     * @param $name
     * @return mixed
     */
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    /**
     * @param $query
     * @param $title
     * @return mixed
     */
    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    /**
     * @param $query
     * @param $abbreviation
     * @return mixed
     */
    public function scopeAbbreviation($query, $abbreviation)
    {
        return $query->where('abbreviation', 'like', '%' . $abbreviation . '%');
    }

    /**
     * @param $query
     * @param $native
     * @return mixed
     */
    public function scopeNative($query, $native)
    {
        return $query->where('native', 'like', '%' . $native . '%');
    }

    /**
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeEmail($query, $email)
    {
        return $query->where('email', 'like', '%' . $email . '%');
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @param $query
     * @param $address
     *
     * @return mixed
     */
    public function scopeAddress($query, $address)
    {
        return $query->where('address', $address);
    }


    /**
     * @param $query
     * @param $default
     *
     * @return mixed
     */
    public function scopeDefault($query, $default)
    {
        return $query->where('default', $default);
    }

    /**
     * @param $query
     * @param $locale
     *
     * @return mixed
     */
    public function scopeLocale($query, $locale)
    {
        return $query->where('locale', $locale);
    }

    /**
     * @param $query
     * @param $key
     *
     * @return mixed
     */
    public function scopeKey($query, $key)
    {
        return $query->where('key', 'like', '%' . $key . '%');
    }

    /**
     * @param $query
     * @param $group
     *
     * @return mixed
     */
    public function scopeGroup($query, $group)
    {
        return $query->where('group', 'like', '%' . $group . '%');
    }

    /**
     * @param $query
     * @param $text
     *
     * @return mixed
     */
    public function scopeText($query, $text)
    {
        return $query->where('group',$text);
    }


    /**
     * @param $query
     * @param $verify
     *
     * @return mixed
     */
    public function scopeVerify($query, $verify)
    {
        return $query->where('verify', $verify);
    }
}
