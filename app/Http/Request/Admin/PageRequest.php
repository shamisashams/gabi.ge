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

use App\Models\Language;
use App\Models\PageLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
        $page = PageLanguage::where(['page_id' => $this->page, 'language_id' => $localizationID])->first();
        return [
            'title' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
//            'content' => 'nullable|string',
            'slug' => [
                'required',
                $page ? Rule::unique('page_languages', 'slug')->ignore($page->id) :
                    Rule::unique('page_languages', 'slug')
            ],
        ];
    }
}
