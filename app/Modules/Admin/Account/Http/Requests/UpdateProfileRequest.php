<?php

namespace App\Modules\Admin\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateProfileRequest.
 */
class UpdateProfileRequest extends FormRequest
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
            'avatar' => [
                'sometimes',
                'file',
                'max:'.config('upload.file_max_size'),
                'mimetypes:'.implode(',', config('upload.image_mime_types_allow')),
            ],
            'first_name' => 'nullable|max:255',
            'last_name' => 'nullable|max:255',
            'phone' => [
                'nullable',
                'regex:'.config('regex.phone_number'),
                Rule::unique('admins')->ignore(adminInfo()->id()),
            ],
            'address' => 'nullable|max:255'
        ];
    }
}
