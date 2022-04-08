<?php
/**
 *  app/Http/Request/Admin/UserRequest.php
 *
 * User:
 * Date-Time: 15.12.20
 * Time: 13:57
 * @author Insite International <hello@insite.international>
 */

namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
        if ($this->method() === 'GET') {
            return [];
        }
        $rules = [

        ];



        return $rules;
    }
}
