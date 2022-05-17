<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BlogLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_id',
        'language_id',
        'title',
        'title_2',
        'text',
        'text_2',
        'text_3',
        'slug',
        'meta_description',
        'meta_keywords',
    ];

    public function blog():HasOne{
        return $this->hasOne(Blog::class);
    }
}
