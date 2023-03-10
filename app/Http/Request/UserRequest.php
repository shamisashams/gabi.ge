<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'country' => 'nullable',
            'country_id.*' => 'required',
            'city_id.*' => 'required',
            'city' => 'nullable',
            'address.*' => 'required',
            'phone' => 'required|string|max:100'
        ];
    }
}
