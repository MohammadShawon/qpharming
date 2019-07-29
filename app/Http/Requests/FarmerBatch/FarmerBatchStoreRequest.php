<?php

namespace App\Http\Requests\FarmerBatch;

use Illuminate\Foundation\Http\FormRequest;

class FarmerBatchStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function authorize()
     {
         return true;
     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'batch_name'           => 'required|unique:farmer_batches,batch_name',
            'batch_number'         => 'required|unique:farmer_batches,batch_number',
            'status'               => 'required',
        ];
    }
}
