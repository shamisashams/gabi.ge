<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeFeatureFilter;
use App\Traits\ScopeFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Feature extends Model
{
    use HasFactory, Notifiable, ScopeFeatureFilter, HasRolesAndPermissions, SoftDeletes;


    protected $fillable = [
        'position',
        'status',
        'slug',
        'type',
    ];

    public function language()
    {
        return $this->hasMany('App\Models\FeatureLanguage', 'feature_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\ProductFreatures', 'feature_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\FeatureAnswers', 'feature_id');
    }

    public function answer()
    {
        return $this->belongsToMany(Answer::class, 'feature_answers');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
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
            'type' => [
                'hasParam' => true,
                'scopeMethod' => 'type'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
        ];
    }
}
