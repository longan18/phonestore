<?php

namespace App\Modules\Client\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @AccountRequest
 */
class AccountRegisterRequest extends FormRequest
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
            'email' => 'bail|required|email|unique:users,email',
            'email' => [
                'bail',
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'phone' => [
                'bail',
                'required',
                Rule::unique('users')->ignore($this->route('user')),
                "regex:".REGEX_PHONE
            ],
            'password' => [
                'bail',
                Rule::requiredIf(fn () => !$this->route('user')),
                'min:6',
                'confirmed',
            ],
            'password_confirmation' => 'bail|required',
        ];
    }
}
