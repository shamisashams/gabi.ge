<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeSaleFilter;
use App\Traits\ScopeSliderFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Slider extends Model
{
    use HasFactory, Notifiable, ScopeSliderFilter, HasRolesAndPermissions, SoftDeletes;


    protected $fillable = [
        'position',
        'status',
        'redirect_url',
        'type',
        'h_tag'
    ];


    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function language()
    {
        return $this->hasMany(SliderLanguage::class, 'slider_id');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
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
            'slug' => [
                'hasParam' => true,
                'scopeMethod' => 'slug'
            ],
            'redirect_url' => [
                'hasParam' => true,
                'scopeMethod' => 'redirectUrl'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
        ];
    }

    public function setHTagAttribute($value)
    {


        $this->attributes['h_tag'] = json_encode($value);
    }

    public function getHTagAttribute($value)
    {


        return json_decode($value);
    }
}
