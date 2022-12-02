<?php

namespace App\Http\Requests;

use App\Models\BonExchange;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * @see \Tests\Todo\Unit\Http\Requests\StorePollTest
 */
class StoreTransactionRequest extends FormRequest
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
        return [
            'exchange'   => [
                'bail',
                'required',
                'exists:bon_exchange,id',
                function ($attribute, $value, $fail) use ($request) {
                    $user = $request->user();
                    $item = BonExchange::findOrFail($value);

                    switch (true) {
                        case $item->cost > $user->seedbonus:
                            $fail('Not enough BON.');
                            break;
                        case $item->download && $user->downloaded < $item->value:
                            $fail('Not enough download.');
                            break;
                        case $item->personal_freeleech && $user->personalFreeleeches()->exists():
                            $fail('Your previous personal freeleech is still active.');
                            break;
                    }
                },
            ],
        ];
    }
}
