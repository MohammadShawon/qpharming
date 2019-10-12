<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'purposehead_id' => 'exists:purpose_heads,id',
            'bank_id'        => 'exists:banks,id',
            'payment_amount' => 'required|numeric',
            'payment_type'   => 'required',
            'bank_name'      => 'nullable',
            'received_by'    => 'nullable',
            'remarks'        => 'nullable',
            'reference'      => 'nullable',
            'payment_date'   => 'required',
        ];
    }
}
