<?php

namespace App\Modules\Client\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @AccountRequest
 */
class AccountUpdateRequest extends FormRequest
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
            'name' => 'bail|required',
            'email' => [
                'bail',
                'required',
                'email',
                Rule::unique('users')->ignore($this->id),
            ],
            'phone' => [
                'bail',
                'required',
                Rule::unique('users')->ignore($this->id),
                "regex:".REGEX_PHONE
            ],
            'password' => [
                'bail',
                'nullable',
                Rule::requiredIf(fn () => !$this->id),
                'min:6'
            ],
        ];
    }
}
