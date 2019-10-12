<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseStoreRequest extends FormRequest
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
            'expensehead_id' => 'required',
            'amount'         => 'required',
            'description'    => 'nullable',
            'recipient_name' => 'nullable',
            'user_id'        => 'required',
        ];
    }
}
