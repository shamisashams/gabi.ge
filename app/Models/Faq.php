<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeAnswerFilter;
use App\Traits\ScopeFeatureFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Faq extends Model
{
    use HasFactory, ScopeAnswerFilter;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'h_tag'
    ];

    public function language()
    {
        return $this->hasMany('App\Models\FaqLanguage', 'faq_id');
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
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
            'position' => [
                'hasParam' => true,
                'scopeMethod' => 'position'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
            'feature' => [
                'hasParam' => true,
                'scopeMethod' => 'feature'
            ],
        ];
    }

    public function setHTagAttribute($value)
    {

        //dd($value);
        $this->attributes['h_tag'] = json_encode($value);
    }

    public function getHTagAttribute($value)
    {


        return json_decode($value);
    }
}
