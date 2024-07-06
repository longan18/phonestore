<?php

namespace App\Modules\Admin\ProductSmartphone\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @ProductSmartphoneRequest
 */
class ProductSmartphoneRequest extends FormRequest
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
            'thumb_avatar_product' => [
                'bail',
                Rule::requiredIf(fn () => !$this->route('product')),
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
            'sub_image.*' => [
                'file',
                'max:'.config('upload.file_max_size'),
                'mimetypes:'.implode(',', config('upload.image_mime_types_allow')),
            ],
            'name' => [
                'bail',
                'required',
                Rule::unique('products')
                    ->ignore($this->route('product'))
                    ->whereNull('deleted_at'),
                'string',
                'max:255'
            ],
            'brand_id' => 'bail|required',
            'category_id' => 'bail|required',
            'widescreen' => 'bail|required',
            'scanning_frequency' => 'bail|required',
            'maximum_brightness' => 'bail|required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'brand_id.required' => 'The brand field is required.',
            'category_id.required' => 'The category field is required.'
        ];
    }
}
