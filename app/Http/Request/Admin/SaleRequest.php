<?php
/**
 *  app/Http/Request/Admin/SaleRequest.php
 *
 * User:
 * Date-Time: 9.06.21
 * Time: 10:36
 * @author Gio Bakhbaia <gbaxbaia@gmail.com>
 */

namespace App\Http\Request\Admin;

use App\Models\Sale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaleRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'discount' => [
                'required',
                'numeric',
                'max:1000000',
                function ($attribute, $value, $fail) {
                    if ($this->type == Sale::TYPE_PERCENT && $value > 100) {
                        $fail('The ' . $attribute . ' should be less or equal to 100');
                    }
                },
            ],
            'type' => ['required', 'string', 'max:255'],
        ];
    }
}
