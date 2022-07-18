<?php

namespace App\Models;

use App\Traits\ScopeSettingFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Country extends Model
{
    use HasFactory, ScopeSettingFilter;

    protected $table = 'countries';

    protected $fillable = [
        'code',
    ];

    public function languages():HasMany{
        return $this->hasMany(CountryTranslation::class,'country_id');
    }

    public function language(): HasOne{
        return $this->hasOne(CountryTranslation::class)->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function availableLanguage()
    {
        return $this->languages()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function cities():HasMany{
        return $this->hasMany(City::class);
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
