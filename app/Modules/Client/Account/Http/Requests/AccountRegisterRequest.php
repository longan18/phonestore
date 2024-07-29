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

    public function messages() {
        return [
            'name.required' => 'Họ và tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',

            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',

            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải lớn hơn hoặc bằng 6 kí tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp.',

            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống.',
        ];
    }
}
