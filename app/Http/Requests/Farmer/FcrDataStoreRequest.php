<?php

namespace App\Http\Requests\Farmer;

use Illuminate\Foundation\Http\FormRequest;

class FcrDataStoreRequest extends FormRequest
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
            'farmer_id'                     => 'required | exists:farmers,id',
            'batch_number'                  => 'required',
            'given_chicks_quantity'         => 'numeric',
            'chicks_rate'         => 'numeric',
            'sold_quantity'         => 'numeric',
            'sold_kg'         => 'numeric',
            'average_weight'         => 'numeric',
            'farm_loose_quantity'         => 'numeric',
            'farm_loose_kg'         => 'numeric',
            'farm_stock_quantity'         => 'numeric',
            'farm_stock_kg'         => 'numeric',
            'cartoon_dead'         => 'numeric',
            'farm_dead'         => 'numeric',
            'missing_quantity'         => 'numeric',
            'missing_kg'         => 'numeric',
            'bonus_chicks'         => 'numeric',
            'bonus_chicks_money'         => 'numeric',
            'excess_dead'         => 'numeric',
            'farm_loose_cutting'         => 'numeric',
            'farm_stock_cutting'         => 'numeric',
            'excess_dead_cutting'         => 'numeric',
            'missing_chicks_cutting'         => 'numeric',
            'excess_feed_cutting'         => 'numeric',
            'report_book_cutting'         => 'numeric',
            'transport_cost'         => 'numeric',
            'stamp_cost'         => 'numeric',
            'advance_payment'         => 'numeric',
            'previous_due'         => 'numeric',
            'others_cutting'         => 'numeric',
            'feed_eaten_sacks'         => 'numeric',
            'fcr'         => 'numeric',
            'commission_rate'         => 'numeric',
            'selling_rate'         => 'numeric',
            'farm_loose_rate'         => 'numeric',
            'sub_total'         => 'numeric',
            'total_cutting_amount'         => 'numeric',
            'grand_total'         => 'numeric',
        ];
    }
}
