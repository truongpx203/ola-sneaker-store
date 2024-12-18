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
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [

            // 10/12/2024
            'subject.required' => 'Vui lòng nhập tiêu đề.',
            'subject.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'subject.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'message.required' => 'Vui lòng nhập nội dung.',
            'message.string' => 'Nội dung phải là chuỗi ký tự.',
        ];
    }
}
