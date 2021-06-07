<?php

 namespace App\Http\Request\Admin;

 use Illuminate\Foundation\Http\FormRequest;
 use Illuminate\Validation\Rule;
 use Illuminate\Support\Facades\Route;

 class ProductRequest extends FormRequest
 {

     /**
      * Determine if the user is authorized to make this request.
      *
      * @return bool
      */
     public function authorize()
     {
	 return Auth()->user()->can('isAdmin');
     }

     /**
      * Get the validation rules that apply to the request.
      *
      * @return array
      */
     public function rules()
     {

	 $rules = [
	     'title' => 'required|string|max:255',
	     //'category' => 'required|integer',
	     'position' => 'required|string|max:255',
	     'price' => 'required|numeric',
	     'description' => 'required|string',
	     //     'sale_price' => 'nullable|numeric',
	     'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096'
	 ];

	 if (Route::currentRouteName() !== 'productUpdate') {
	     // TODO : new logic
	     $rules['slug'] = ['required', 'alpha_dash', Rule::unique('product_languages', 'slug')->ignore($this->product)];
	 }

	 return $rules;
     }

 }
 