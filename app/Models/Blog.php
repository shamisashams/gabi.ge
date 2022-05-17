<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeFeatureFilter;
use App\Traits\ScopeProductFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Blog extends Model
{

    use HasFactory, ScopeProductFilter, SoftDeletes;


    protected $fillable = [
        'status',
    ];

    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }
    public function firstImage(){
        return $this->morphOne(File::class,'fileable')->oldestOfMany();
    }

    public function language()
    {
        return $this->hasMany('App\Models\BlogLanguage', 'blog_id');
    }

    public function languageS()
    {
        return $this->hasOne('App\Models\BlogLanguage', 'blog_id');
    }





    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function availableLanguageS()
    {
        return $this->languageS()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }





    public function scopeByLang($query)
    {
        $localizationID = Language::getIdByName(app()->getLocale());
        return $query->whereHas('language', function ($query) use ($localizationID) {
            $query->where('language_id', $localizationID);
        });
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

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->format('d/m/Y');
    }
}
