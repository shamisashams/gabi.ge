<?php

 /**
  *  database/seeders/LocalizationSeeder.php
  *
  * User:
  * Date-Time: 07.12.20
  * Time: 11:53
  * @author Giorgi Bakhbaia <gbaxbaia@gmail.com>
  */

 namespace Database\Seeders;

 use App\Models\Category;
 use App\Models\CategoryLanguage;
 use App\Models\Localization;
 use Carbon\Carbon;
 use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;

 class CategorySeeder extends Seeder
 {

     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run()
     {

	 $categories = [
	     [
		 'position' => '1',
		 'status' => true
	     ],
	     [
		 'position' => '2',
		 'status' => true
	     ],
	     [
		 'position' => '3',
		 'status' => true
	     ],
	     [
		 'position' => '4',
		 'status' => true
	     ],
	     [
		 'position' => '5',
		 'status' => true
	     ],
	     [
		 'position' => '6',
		 'status' => true
	     ],
	 ];

	 $categoryLanguages = [
	     [
		 'language_id' => 1,
		 'title' => 'კლიმატის მოწყობილობები',
		 'description' => 'კლიმატის მოწყობილობა აღწერა',
		 'slug' => 'კლიმატის-მოწყობილობა',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 1,
		 'title' => 'პატარა სახლის ნივთები',
		 'description' => 'პატარა ნივთები სახლში ლორემ იპსუმ',
		 'slug' => 'პატარა-ნივთები',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 1,
		 'title' => 'ტელევიზორი და გასართობი მედია',
		 'description' => 'ტელევიზორებიიი',
		 'slug' => 'ტელევიზორები-მედია',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 1,
		 'title' => 'დიდი სახლის ნივთბი',
		 'description' => 'დიდი სახლისნივთები ასდასასდ',
		 'slug' => 'დიდი-სახლი',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 1,
		 'title' => 'კომპიუტერული ტექნოლოგიები',
		 'description' => 'კომპიუტერული ტექნიკა ლორემიპსუმსად ასდასასდ',
		 'slug' => 'კომპიუტერული-ტექნიკა',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 1,
		 'title' => 'ტელეფონები და აქსესუარები',
		 'description' => 'ტელეფონები და აქსესუარების საუკეთსო ფასად',
		 'slug' => 'ტელეფონები-აქესესუარები',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 2,
		 'title' => 'CLimatic Equipment',
		 'description' => 'Thats Climatic equitmen',
		 'slug' => 'climatic-equipment'
	     ],
	     [
		 'language_id' => 2,
		 'title' => 'Small Home Appliances',
		 'description' => 'SMALL HOME APPPS',
		 'slug' => 'small-home-appliances',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 2,
		 'title' => 'TV Entertainment faccilities',
		 'description' => 'TV fac lorem ipsum',
		 'slug' => 'TVs-entertainment-facilities',
		 'parent_id' => null
	     ],
	     [
		 'language_id' => 2,
		 'title' => 'Large Household Appppp',
		 'description' => 'DESC LARGE HOUSEHOLD',
		 'slug' => 'large-household-appliances',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 2,
		 'title' => 'Computer technology',
		 'description' => "Computer TEchnology",
		 'slug' => 'computer-technology',
		 'parent_id' => null,
	     ],
	     [
		 'language_id' => 2,
		 'title' => 'Phones and accessories',
		 'description' => "phone accesssories desc",
		 'slug' => 'phones-accessories',
		 'parent_id' => null,
	     ]
	 ];

	 $array = [];
	 $i = 0;
	 foreach ($categories as $category) {
	     $model = new Category([
		 'position' => $category['position'],
		 'status' => $category['status']
	     ]);
	     $model->save();
	     $array[] = $model->id;
	 }

	 foreach ($categoryLanguages as $category) {
	     $model = new CategoryLanguage([
		 'category_id' => $array[$i],
		 'language_id' => $category['language_id'],
		 'title' => $category['title'],
		 'description' => $category['description'],
		 'slug' => $category['slug']
	     ]);
	     $model->save();
	     if ($i == 5) {
		 $i = 0;
		 continue;
	     }
	     $i++;
	 }
     }

 }
 