<?php

namespace App\Http\Requests\ProductPrice;

use Illuminate\Foundation\Http\FormRequest;

class ProductPriceUpdateRequest extends FormRequest
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
            'quantity' => 'required|numeric',
            'cost'     => 'required|numeric',
            'sell'     => 'required|numeric',
            'mfg_date' => 'date | nullable',
            'exp_date' => 'date | nullable',
        ];
    }
}
