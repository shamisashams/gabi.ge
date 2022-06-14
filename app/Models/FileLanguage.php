<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

 class FileLanguage extends Model
 {

     use HasFactory;

     protected $fillable = [
         'file_id',
         'language_id',
         'title',
     ];

 }
