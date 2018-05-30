<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'desc'  => 'required',
            'price' => 'required|numeric',
            'old_price' => 'numeric'
        ];
    }

    public function messages()
    {
        return array_merge(parent::messages(), []);
    }
}
