<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Vui lòng nhập họ tên.',
            // 'email.required' => 'Vui lòng nhập email.',
            // 'email.email' => 'Email không hợp lệ.',
            // 'message.required' => 'Vui lòng nhập nội dung.',

            // 10/12/2024

            'name.required' => 'Vui lòng nhập họ tên.',
            'name.string' => 'Họ tên phải là chuỗi ký tự.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'subject.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'subject.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'message.required' => 'Vui lòng nhập nội dung.',
            'message.string' => 'Nội dung phải là chuỗi ký tự.',
        ];
    }
}
