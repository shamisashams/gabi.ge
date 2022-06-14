<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'faq_id',
        'language_id',
        'question',
        'answer'
    ];

    public function faq():BelongsTo
    {
        return $this->belongsTo(Help::class,'help_id');
    }

    public function language():BelongsTo
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
