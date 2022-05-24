<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'format'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function languages():HasMany{
        return $this->hasMany(FileLanguage::class);
    }

    public function availableLanguage()
    {
        return $this->languages()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }
}
