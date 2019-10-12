<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'product_name' => 'required',
            'company_id'   => 'required | exists:companies,id',
            'sku'          => 'required|unique:products',
            'barcode'      => 'nullable|numeric|unique:products',
            'unit_id'      => 'required',
            'size'         => 'required',
            'cost_price'   => 'required',
            'selling_price'=> 'required',
            'quantity'     => 'required|numeric',
        ];
    }
}
