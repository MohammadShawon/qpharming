<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'product_name' => 'required',
            'sku'          => 'required',
            'barcode'      => 'nullable|numeric',
            'unit_id'      => 'required',
            'size'         => 'required',
//            'cost_price'    => 'required',
//            'selling_price' => 'required',
//            'quantity'     => 'required|numeric',
        ];
    }
}
