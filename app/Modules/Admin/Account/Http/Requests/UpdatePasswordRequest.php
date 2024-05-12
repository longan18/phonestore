<?php

namespace App\Modules\Admin\Account\Http\Requests;

use App\Rules\VerifyPasswordOldRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePasswordRequest.
 */
class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password'      => [
                'required',
                new VerifyPasswordOldRule(adminInfo()->user()),
            ],
            'password'              => [
                'required',
                'min:6',
                'regex:'.config('regex.password'),
            ],
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ];
    }
}
