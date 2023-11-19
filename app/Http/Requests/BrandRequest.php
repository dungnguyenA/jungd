<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [];

        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'create_brand':
                        $rules = [
                            'name' => 'required|min:2|max:255|regex:/^[a-zA-ZÀ-Ỹà-ỹ ]+$/',
                        ];
                    break;
                    case 'edit_brand':
                        $rules = [
                            'name' => 'required|min:2|max:255|regex:/^[a-zA-ZÀ-Ỹà-ỹ ]+$/',
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
            'name.min' => 'Product Name không được nhập nhỏ hơn 2 kí tự',
            'name.max' => 'Product Name không được nhập lớn hơn 255 kí tự',
            'name.regex' => 'Product Name chỉ được nhập chữ',
        ];
    }
}
