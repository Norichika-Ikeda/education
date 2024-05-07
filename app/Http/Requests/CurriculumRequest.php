<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'image' => 'file|image|mimes:jpeg,png,jpg',
            'description' => 'string|max:4294967295|nullable',
            'movie' => 'string|max:16777215|nullable',
            'flag' => '',
            'grade' => 'required|integer|max:10',
        ];
    }
}
