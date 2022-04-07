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
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'sale' => 'nullable|numeric',
            'feature.*' => 'numeric',
            'answers.*' => 'string',
            'description' => 'required|string',
            //'sale_price' => 'nullable|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'weight' => 'required|numeric',
            'short_description' => 'nullable|string',
            'shipping' => 'nullable|string'
        ];
//
//         if (Route::currentRouteName() !== 'productUpdate') {
//             // TODO : new logic
//             $rules['slug'] = ['required', 'alpha_dash', Rule::unique('product_languages', 'slug')->ignore($this->product)];
//         }

        return $rules;
    }

}
