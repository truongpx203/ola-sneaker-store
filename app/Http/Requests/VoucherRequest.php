<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class VoucherRequest extends FormRequest
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
                            'code' => [
                                'required',
                                Rule::unique('vouchers')
                            ],
                            'value' => [
                                'required',
                                'numeric',
                                'min:1',
                                'max:100'
                            ],
                            'description' => [
                                'required',
                            ],
                            'max_price' => [
                                'required',
                                'numeric',
                                'min:0'
                            ],
                            'start_datetime' => [
                                'required',
                                'after_or_equal:' . Carbon::now()->format('Y-m-d H:i'),
                            ],
                            'end_datetime' => [
                                'required',
                                'after_or_equal:start_datetime'
                            ],
                            'quantity' => [
                                'required',
                                'numeric',
                                'min:1'
                            ],
                            'for_user_ids' => [
                                'required_without:user_use',
                            ],
                            'user_use' => [
                                'required_without:for_user_ids',
                            ]
                        ];
                        break;
                }
                break;
            case 'PUT':
                switch ($currentMethod) {
                    case 'store':
                        $rules = [
                            'value' => [
                                'required',
                                'numeric',
                                'min:1',
                                'max:100',
                            ],
                            'description' => [
                                'required',
                            ],
                            'max_price' => [
                                'required',
                                'numeric',
                                'min:0',
                            ],
                            'start_datetime' => [
                                'required',
                                'after_or_equal:' . now()->format('Y-m-d H:i'),
                            ],
                            'end_datetime' => [
                                'required',
                                'after_or_equal:start_datetime',
                            ],
                            'quantity' => [
                                'required',
                                'numeric',
                                'min:1',
                            ],
                            'for_user_ids' => [
                                'required_without:user_use',
                            ],
                            'user_use' => [
                                'required_without:for_user_ids',
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
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại',
            'numeric' => ':attribute không phải là số',
            'min' => ':attribute ít hơn giá trị tối thiểu',
            'max' => ':attribute quá giá trị tối đa',
            'start_datetime.after_or_equal' => ':attribute phải lớn hơn ngày hiện tại',
            'end_datetime.after_or_equal' => ':attribute phải lớn hơn ngày bắt đầu',
            'date' => ':attribute không phải là một ngày hợp lệ',
            'required_without' => 'Cần ít nhất một trong hai trường: ' . $this->attributes()['for_user_ids'] . ' hoặc ' . $this->attributes()['user_use'] . '.',
        ];
    }
    public function attributes()
    {
        return [
            'code'  => 'Mã giảm giá',
            'value'  => 'Phần trăm giảm',
            'description'  => 'Mô tả',
            'max_price'  => 'Giá tối đa',
            'start_datetime'  => 'Ngày bắt đầu',
            'end_datetime'  => 'Ngày kết thúc',
            'quantity'  => 'Số lượng',
            'for_user_ids'  => 'Người được cấp riêng',
            'user_use'  => 'Khối người dùng'
        ];
    }
}
