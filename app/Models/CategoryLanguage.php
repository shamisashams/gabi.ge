<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

 class CategoryLanguage extends Model
 {

     use HasFactory;

     protected $fillable = [
         'category_id',
         'language_id',
         'title',
         'description',
         'meta_title',
         'meta_description',
         'meta_keyword',
         'slug'
     ];

 }
