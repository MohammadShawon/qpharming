<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'company'               => 'required|unique:companies,name',
            'phone1'                => 'required|unique:companies,phone1',
            'email'                 => 'nullable|unique:companies,email',
            'address'               => 'nullable',
            'representative_name'   => 'nullable',
            'type'                  => 'required',
            'opening_balance'       => 'required|numeric'
        ];
    }
}
