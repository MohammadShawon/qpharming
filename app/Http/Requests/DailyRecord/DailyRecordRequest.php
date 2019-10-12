<?php

namespace App\Http\Requests\DailyRecord;

use Illuminate\Foundation\Http\FormRequest;

class DailyRecordRequest extends FormRequest
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
            'farmer_id'             => 'required | exists:farmer_batches,farmer_id',
            'date'                  => 'required',
            'died'                  => 'required',
            'feed'                  => 'required',
            'weight'                => 'required',
            'symptoms'              => 'nullable',
            'remarks'               => 'nullable',
        ];
    }
}
