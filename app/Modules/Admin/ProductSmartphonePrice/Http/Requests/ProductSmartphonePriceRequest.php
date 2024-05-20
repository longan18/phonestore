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
                Rule::requiredIf(fn () => !$this->route('product')),
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
            'item_id' => [
                'bail',
                Rule::requiredIf(fn () => !$this->route('product')),
            ],
            'price' => 'bail|required|numeric|min:1',
            'ram' => 'bail|required|numeric|min:1',
            'color' => 'bail|required',
            'hex_color' => 'bail|required|hex_color',
            'quantity' => 'bail|required|numeric|min:1',
            'storage_capacity' => 'bail|required',
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
                    'price' => str_replace(',', '', request('price')),
                ]
            );
        }
    }
}
