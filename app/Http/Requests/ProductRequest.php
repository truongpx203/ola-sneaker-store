<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:products,code,' . ($this->route('product') ? $this->route('product')->id : 'NULL'),
            'category_id' => 'required|exists:categories,id',
            'summary' => 'required|string',
            'detailed_description' => 'required|string',

          'variants.*.size_id' => [
            'required',
            'exists:product_sizes,id',
            function($attribute, $value, $fail) {
                $sizeIds = collect($this->variants)->pluck('size_id');
                if ($sizeIds->count() !== $sizeIds->unique()->count()) {
                    $fail('Kích thước không được trùng lặp.');
                }
            },
        ],
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.listed_price' => 'required|numeric|min:0',
            'variants.*.sale_price' => 'nullable|numeric|min:0',
            'variants.*.import_price' => 'required|numeric|min:0',
            'variants.*.is_show' => 'required|boolean',
        ];

        if ($this->isMethod('post')) {
            $rules['primary_image_url'] = 'required|image|mimes:jpeg,png,jpg,gif,svg';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['primary_image_url'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'code.required' => 'Mã sản phẩm là bắt buộc.',
            'code.unique' => 'Mã sản phẩm này đã tồn tại.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'primary_image_url.image' => 'Tệp tải lên phải là ảnh.',
            'primary_image_url.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'summary.required' => 'Vui lòng điền mô tả ngắn.',
            'detailed_description.required' => 'Vui lòng điền mô tả chi tiết.',
            'variants.*.size_id.required' => 'Kích thước là bắt buộc.',
            'variants.*.stock.required' => 'Số lượng là bắt buộc.',
            'variants.*.listed_price.required' => 'Giá niêm yết là bắt buộc.',
            'variants.*.import_price.required' => 'Giá nhập là bắt buộc.',
        ];
    }
}
