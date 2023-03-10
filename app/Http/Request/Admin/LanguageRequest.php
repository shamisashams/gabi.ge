<?php
/**
 *  app/Http/Request/Admin/LocalizationRequest.php
 *
 * User:
 * Date-Time: 15.12.20
 * Time: 14:09
 * @author Insite International <hello@insite.international>
 */

namespace App\Http\Request\Admin;

use App\Models\Language;
use App\Models\Localization;
use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'abbreviation' => 'required|string|max:255',
            'native' => 'required|string|max:255',
            'locale' => 'required|string|max:255',
        ];

        $localization = Language::where('default', true)->first();
        if ($localization == null) {
            $rules['default'] = 'required';
        }

        return $rules;
    }
}
