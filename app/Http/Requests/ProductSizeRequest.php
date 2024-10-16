<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductSizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $currentMethod = $this->route()->getActionMethod();
        $rules = [];
        switch ($this->method()) {
            case 'POST':
                switch ($currentMethod) {
                    case 'store':
                        $rules = [
                            'name' => [
                                'required',
                                Rule::unique('product_sizes')
                            ],

                        ];
                        break;
                }
                break;
            case 'PUT':
                switch ($currentMethod) {
                    case 'update':
                        $rules = [
                            'name' => [
                                'required',
                                Rule::unique('product_sizes')->where(function ($query) {
                                    return $query->where('id', '!=', $this->id);
                                })
                            ],
                        ];
                        break;
                }
                break;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ":attribute không được để trống",
            'unique' => ':attribute đã tồn tại',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên kích thước',
        ];
    }
}
