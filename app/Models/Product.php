<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeFeatureFilter;
use App\Traits\ScopeProductFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

    use HasFactory, Notifiable, ScopeProductFilter, HasRolesAndPermissions, SoftDeletes;


    protected $fillable = [
        'category_id',
        'position',
        'status',
        'slug',
        'price',
        'vip',
        'sale',
        'sale_price',
        'view',
        'weight'
    ];

    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }

    public function language()
    {
        return $this->hasMany('App\Models\ProductLanguage', 'product_id');
    }

    public function features()
    {
        return $this->hasMany('App\Models\ProductFeatures', 'product_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\ProductAnswers', 'product_id');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function categoryLanguage()
    {
        return $this->hasMany(CategoryLanguage::class, 'category_id', 'category_id')
            ->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function saleProduct()
    {
        return $this->hasOne(SaleProduct::class, 'product_id', 'id');
    }

    public function scopeByLang($query)
    {
        $localizationID = Language::getIdByName(app()->getLocale());
        return $query->whereHas('language', function ($query) use ($localizationID) {
            $query->where('language_id', $localizationID);
        });
    }

    public static function calculatePrice($price, $discount, $type)
    {
        if ($type == 'fixed') {
            return round(($price / 100) - $discount, 2);
        }
        if ($type == "percent") {
            return round(($price / 100) - ((($price / 100) * $discount) / 100), 2);
        }
    }


    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'title' => [
                'hasParam' => true,
                'scopeMethod' => 'title'
            ],
            'description' => [
                'hasParam' => true,
                'scopeMethod' => 'description'
            ],
            'min_price' => [
                'hasParam' => true,
                'scopeMethod' => 'minPrice'
            ],
            'max_price' => [
                'hasParam' => true,
                'scopeMethod' => 'maxPrice'
            ],
            'answer' => [
                'hasParam' => true,
                'scopeMethod' => 'type'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
            'category' => [
                'hasParam' => true,
                'scopeMethod' => 'categoryId'
            ],
            'sortParams' => [
                'hasParam' => true,
                'scopeMethod' => 'sorted'
            ],
            'feature' => [
                'hasParam' => true,
                'scopeMethod' => 'feature'
            ]
        ];
    }
}
