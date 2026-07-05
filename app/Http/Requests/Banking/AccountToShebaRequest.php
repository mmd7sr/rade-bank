<?php

declare(strict_types=1);

namespace App\Http\Requests\Banking;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountToShebaRequest extends FormRequest
{
    /**
     * Only authenticated users may convert an account to sheba.
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
            'accountNumber' => ['required', 'string', 'max:30', 'regex:/^[0-9.\-]+$/'],
            'bankCode' => ['required', 'string', Rule::in(array_keys((array) config('banks.list')))],
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
            'accountNumber.required' => 'شماره حساب الزامی است.',
            'accountNumber.string' => 'شماره حساب باید به صورت رشته وارد شود.',
            'accountNumber.max' => 'شماره حساب بیش از حد مجاز طولانی است.',
            'accountNumber.regex' => 'شماره حساب تنها می‌تواند شامل ارقام باشد.',
            'bankCode.required' => 'انتخاب بانک الزامی است.',
            'bankCode.in' => 'بانک انتخاب‌شده معتبر نیست.',
        ];
    }
}
