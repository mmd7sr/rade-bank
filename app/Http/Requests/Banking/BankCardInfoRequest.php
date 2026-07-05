<?php

declare(strict_types=1);

namespace App\Http\Requests\Banking;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BankCardInfoRequest extends FormRequest
{
    /**
     * Only authenticated users may inquire card info.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, ValidationRule|string>>
     */
    public function rules(): array
    {
        return [
            'cardNumber' => ['required', 'string', 'regex:/^\d{16}$/'],
        ];
    }

    /**
     * Persian validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'cardNumber.required' => 'شماره کارت الزامی است.',
            'cardNumber.string' => 'شماره کارت باید به صورت رشته وارد شود.',
            'cardNumber.regex' => 'شماره کارت باید دقیقاً ۱۶ رقم باشد.',
        ];
    }
}
