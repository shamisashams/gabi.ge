<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public $table = 'order_products';
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'total_price',
        'quantity',
        'options'
    ];
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function language()
    {
        return $this->hasMany('App\Models\ProductLanguage', 'product_id','product_id');
    }

    public function availableLanguage() {
        return $this->language()->where('language_id','=', Language::getIdByName(app()->getLocale()));
    }
}
