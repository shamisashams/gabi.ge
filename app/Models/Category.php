<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use App\Traits\ScopeFilter;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Notifications\Notifiable;
 use \App\Traits\HasRolesAndPermissions;

 class Category extends Model
 {

     use HasFactory,
	 Notifiable,
	 ScopeFilter,
	 HasRolesAndPermissions,
	 SoftDeletes;

     protected $fillable = [
	 'position',
	 'status',
	 'parent_id'
     ];

     public function getFilterScopes(): array
     {
	 return [
	     'position' => [
		 'hasParam' => true,
		 'scopeMethod' => 'position'
	     ],
	     'status' => [
		 'hasParam' => true,
		 'scopeMethod' => 'status'
	     ],
	     'text' => [
		 'status' => true,
		 'scopeMethod' => 'status'
	     ],
	 ];
     }

 }
 