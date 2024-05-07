<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryTimeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'curriculum_id' => 'required|integer|max:10',
            'date_from' => 'required',
            'time_from' => 'required',
            'date_to' => 'required',
            'time_to' => 'required',
        ];
    }
}
