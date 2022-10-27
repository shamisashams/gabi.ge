<?php

namespace App\Models;


use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeSettingFilter;
use App\Traits\ScopeSaleFilter;
use App\Traits\ScopeSliderFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class SizeGuide extends Model
{
    use HasFactory, ScopeSettingFilter;
    protected $table = 'sizeguides';
    protected $fillable = [
        // 'age',
        'gender',
        'status',
        'chest',
        'wheist',
        'hips',
        'back',
        'arm',
        'leg',
        'shoulder',
    ];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    // public function language()
    // {
    //     return $this->hasMany(SizeguideLanguage::class, 'sizeguides_id');
    // }

    public function language()
    {
        return $this->hasMany('App\Models\SizeguideLanguage', 'sizeguides_id');
    }

    public function languageS()
    {
        return $this->hasOne('App\Models\SizeguideLanguage', 'sizeguides_id');
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
