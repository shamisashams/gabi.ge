<?php

namespace App\Models;

use App\Traits\ScopeSettingFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shipping extends Model
{
    use HasFactory, ScopeSettingFilter;

    protected $table = 'shipping';

    protected $fillable = [
        'price',
    ];

    public function languages():HasMany{
        return $this->hasMany(ShippingTranslation::class,'shipping_id');
    }

    public function language(): HasOne{
        return $this->hasOne(ShippingTranslation::class)->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function availableLanguage()
    {
        return $this->languages()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
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
