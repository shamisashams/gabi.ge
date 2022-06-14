<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HelpLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'help_id',
        'language_id',
        'title',
        'text'
    ];

    public function help():BelongsTo
    {
        return $this->belongsTo(Help::class,'help_id');
    }

    public function language():BelongsTo
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
