<?php

/**
 *  app/Http/Request/Admin/PageRequest.php
 *
 * User:
 * Date-Time: 17.12.20
 * Time: 17:57
 * @author Insite International <hello@insite.international>
 */

namespace App\Http\Request\Admin;

use App\Models\CategoryLanguage;
use App\Models\Language;
use App\Models\PageLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class CategoryRequest extends FormRequest
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
        $category = CategoryLanguage::where(['category_id' => $this->category, 'language_id' => $localizationID])->first();

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'slug' => ['required','alpha_dash', $category ? Rule::unique('category_languages', 'slug')->ignore($category->id) :
                Rule::unique('category_languages', 'slug')]
        ];


        return $rules;
    }

}
