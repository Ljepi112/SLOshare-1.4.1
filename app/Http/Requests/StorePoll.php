<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @see \Tests\Todo\Unit\Http\Requests\StorePollTest
 */
class StorePoll extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|min:10',
            'options.*' => 'filled',
            'options'   => 'min:2',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'options.*.filled' => 'Izpolniti morate vsa polja možnosti',
        ];
    }
}
