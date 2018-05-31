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
            'old_price' => 'nullable|numeric',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return array_merge(parent::messages(), [
            'category_id.required' => 'Sản phẩm phải có ít nhất 1 Category',
            'title.required' => 'Vui lòng nhập tiêu đề',
            'desc.required' => 'Vui lòng nhập mô tả',
            'price.required' => 'Vui lòng nhập giá',
        ]);
    }
}
