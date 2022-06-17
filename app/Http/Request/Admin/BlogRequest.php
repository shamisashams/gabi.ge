<?php

namespace App\Http\Request\Admin;

use App\Models\BlogLanguage;
use App\Models\CategoryLanguage;
use App\Models\Language;
use App\Models\ProductLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class BlogRequest extends FormRequest
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
        $localizationID = Language::getIdByName(app()->getLocale());
        $blog = BlogLanguage::where(['blog_id' => $this->blog, 'language_id' => $localizationID])->first();

        $rules = [
            'title' => 'required|string|max:255',
            'title_2' => 'nullable|string|max:255',

            'text' => 'required|string',
            //'sale_price' => 'nullable|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'meta_description' => 'nullable|string|max:255',
            //'meta_keyword' => 'nullable|string|max:255',

            'slug' => ['required','alpha_dash', $blog ? Rule::unique('blog_languages', 'slug')->ignore($blog->id) :
                Rule::unique('blog_languages', 'slug')]
        ];
//
//         if (Route::currentRouteName() !== 'productUpdate') {
//             // TODO : new logic
//             $rules['slug'] = ['required', 'alpha_dash', Rule::unique('product_languages', 'slug')->ignore($this->product)];
//         }

        return $rules;
    }

}
