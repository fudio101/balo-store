<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['required', 'string','unique:App\Models\Discount,code,'.$this->request->get('id')],
            'discount' => ['required', 'integer'],
            'limit_number' => ['required', 'integer'],
            'payment_limit' => ['required', 'integer'],
            'expiration_date' => ['required', 'date'],
            'description' => ['string', 'nullable'],
        ];
    }
}
