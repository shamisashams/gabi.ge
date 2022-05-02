<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\ScopeFilter;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Language;
use App\Traits\ScopeCategoryFilter;

class Category extends Model
{

    use HasFactory, Notifiable, ScopeCategoryFilter, HasRolesAndPermissions, SoftDeletes;

    protected $fillable = [
        'position',
        'status',
        'parent_id'
    ];

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
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
            'slug' => [
                'hasParam' => true,
                'scopeMethod' => 'slug'
            ],

        ];
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function language()
    {
        return $this->hasMany(CategoryLanguage::class, 'category_id');
    }

    public function languageS()
    {
        return $this->hasOne(CategoryLanguage::class, 'category_id');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function availableLanguageS()
    {
        return $this->languageS()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getCategoryNameById($parentId)
    {
        $category = Category::where(['id' => $parentId])->first();

        return count($category->availableLanguage) > 0 ? $category->availableLanguage[0]->title : "";
    }

    public function productFeatures()
    {
        return $this->hasManyThrough(ProductFeatures::class, Product::class, 'category_id', 'product_id', 'id', 'id')
            ->groupBy('product_features.feature_id');
    }

    public function scopeByMain($query)
    {
        return $query->where('parent_id', '=', null)->orWhere('parent_id', '=', "");
    }

}
