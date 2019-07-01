<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return false;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company'               => 'required',
            'phone1'                => 'required',
            'email'                 => 'required',
            'address'               => 'required',
            'representative_name'   => 'required',
            'opening_balance'       => 'required|numeric'
        ];
    }
}
