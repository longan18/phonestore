<?php

namespace App\Modules\Admin\ProductSmartphonePrice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @ProductSmartphonePriceRequest
 */
class ProductSmartphonePriceRequest extends FormRequest
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
            'avatar' => [
                'bail',
                Rule::requiredIf(fn () => !$this->route('option')),
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
            'ram_id' => 'bail|required|numeric|min:1',
            'color_id' => 'bail|required',
            'storage_capacity_id' => 'bail|required',
            'price' => 'bail|required|numeric|min:1',
            'quantity' => 'bail|required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'ram_id.required' => 'The ram field is required.',
            'color_id.required' => 'The storage capacity  field is required.',
            'storage_capacity_id.required' => 'The color field is required.',
        ];
    }

    public function getValidatorInstance()
    {
        $this->formatPrice();

        return parent::getValidatorInstance();
    }

    protected function formatPrice()
    {
        if ($this->request->has('price')) {
            $this->merge(
                [
                    'price' => str_replace('.', '', request('price')),
                ]
            );
        }
    }
}
