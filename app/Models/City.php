<?php

namespace App\Models;

use App\Traits\ScopeSettingFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use HasFactory, ScopeSettingFilter;

    protected $table = 'cities';

    protected $fillable = [
        'country_id',
        'code',
        'ship_price',
    ];

    public function languages():HasMany{
        return $this->hasMany(CityTranslation::class,'shipping_id');
    }

    public function language(): HasOne{
        return $this->hasOne(CityTranslation::class)->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function availableLanguage()
    {
        return $this->languages()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function country(): BelongsTo{
        return $this->belongsTo(Country::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'key' => [
                'hasParam' => true,
                'scopeMethod' => 'key'
            ],
            'value' => [
                'hasParam' => true,
                'scopeMethod' => 'settingValue'
            ],
        ];
    }

}
