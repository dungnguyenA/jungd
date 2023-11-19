<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ProductRequest extends FormRequest
{
    public function rules()
    {
        $rules = [];

        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'create_product':
                        $rules = [
                            'name' => 'required|min:2|max:255',
                            'price' => 'required',
                            'quantity' => 'required',
                            'category_id' => 'required',
                            'brand_id' => 'required',
                        ];
                    break;
                    case 'edit_product':
                        $rules = [
                            'name' => 'required|min:2|max:255',
                            'price' => 'required',
                            'quantity' => 'required',
                            'category_id' => 'required',
                            'brand_id' => 'required',
                        ];
                    break;
                endswitch;
                break;
        endswitch;
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Product Name không được bỏ trống',
            'price.required' => 'Price không được bỏ trống',
            'quantity.required' => 'Quantity không được bỏ trống',
            'category_id.required' => 'Category không được bỏ trống',
            'brand_id.required' => 'Brand không được bỏ trống',
            'name.min' => 'ProductName không được nhập nhỏ hơn 2 kí tự',
            'name.max' => 'ProductName không được nhập lớn hơn 255 kí tự',
        ];
    }
}

