<?php

namespace App\Modules\Admin\Brand\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @BrandRequest
 */
class BrandRequest extends FormRequest
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
            'name' => [
                'required',
                'max:255',
                Rule::unique('brands')->ignore($this->id)
            ],
            'avatar' => [
                $this->id ? 'sometimes' : 'required',
                'file',
                'max:'.config('upload.file_max_size'),
                'mimetypes:'.implode(',', config('upload.image_mime_types_allow')),
            ],
        ];
    }
}
