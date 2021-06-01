<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

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

     public function files()
     {
	 return $this->morphMany(File::class, 'fileable');
     }

     public function language()
     {
	 return $this->hasMany(CategoryLanguage::class, 'category_id');
     }

     public function availableLanguage()
     {
	 return $this->language()->where('language_id', '=', Localization::getIdByName(app()->getLocale()));
     }

     public function childCategories()
     {
	 return $this->hasMany(Category::class, 'parent_id');
     }

     public function getCategoryNameById($parentId)
     {
	 $category = Category::where(['id' => $parentId])->first();

	 return count($category->availableLanguage) > 0 ? $category->availableLanguage[0]->title : "";
     }

     public function productFeatures()
     {
	 return $this->hasManyThrough(ProductFeatures::class, Product::class, 'category_id', 'product_id', 'id', 'id')
			 ->groupBy('product_features.feature_id');
     }

 }
 