<?php

namespace App\Http\Requests\FarmerBatch;

use Illuminate\Foundation\Http\FormRequest;

class FarmerBatchUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'batch_name'           => 'required',
            'batch_number'         => 'required',
            'status'               => 'required',
        ];
    }
}
