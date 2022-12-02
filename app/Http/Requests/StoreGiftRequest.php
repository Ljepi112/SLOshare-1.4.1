<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @see \Tests\Todo\Unit\Http\Requests\StorePollTest
 */
class StoreGiftRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $user = $request->user();

        return [
            'to_username'   => [
                'required',
                'exists:users,username',
                Rule::notIn([$user->username]),
            ],
            'bonus_points'  => [
                'required',
                'numeric',
                'min:1',
                'max:'.$user->seedbonus,
            ],
            'bonus_message' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'to_username.exists'           => \trans('bon.failed-user-not-found'),
            'to_username.not_in'           => 'You cannot gift yourself',
            'bonus_points.numeric|min|max' => \trans('bon.failed-amount-message'),
        ];
    }
}
