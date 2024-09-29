<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'full_name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:16',
            'password_confirmation' => 'required|same:password',
            'phone_number' => 'nullable|numeric|digits_between:10,15',
            'address' => 'nullable|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'full_name.required' => 'Tên không được để trống.',
            'full_name.max' => 'Tên không được dài quá 100 ký tự.',
            
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng, vui lòng chọn email khác.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 16 ký tự.',

            'password_confirmation.required' => 'Xác nhận mật khẩu là bắt buộc.',
            'password_confirmation.same' => 'Xác nhận mật khẩu không khớp với mật khẩu.',

            'phone_number.numeric' => 'Số điện thoại chỉ được chứa các chữ số.',
            'phone_number.digits_between' => 'Số điện thoại phải có độ dài từ 10 đến 15 chữ số.',

            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
        ];
    }
}
