<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeguideLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sizeguides_id',
        'language_id',
        'slug',
        'title',
        'age',
        // 'description',
    ];

    public function sizeguide()
    {
        return $this->belongsTo('App\Models\Sizeguide', 'Sizeguide_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
