<?php

namespace App\Http\Requests\Expensehead;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseheadUpdateRequest extends FormRequest
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
            'name' => 'required|unique:expense_heads,name'
        ];
    }
}
