<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingTranslation extends Model
{
    use HasFactory;

    protected $table = 'shipping_translations';

    protected $fillable = [
        'shipping_id',
        'language_id',
        'title',
    ];


}
