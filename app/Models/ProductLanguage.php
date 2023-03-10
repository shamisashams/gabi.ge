<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

 class ProductLanguage extends Model
 {

     use HasFactory;

     protected $fillable = [
	 'product_id',
	 'language_id',
	 'title',
	 'description',
	 'short_description',
	 'shipping',
	 'slug',
	 'meta_title',
	 'meta_description',
	 'meta_keyword'
     ];

     public function product()
     {
	 return $this->belongsTo('App\Models\Product', 'product_id');
     }

     public function language()
     {
	 return $this->belongsTo('App\Models\Localization', 'language_id');
     }

 }
