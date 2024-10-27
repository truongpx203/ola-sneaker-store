<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function storeReview(Request $request)
{
    $validatedData = $request->validate([
        'variant_id' => 'required|exists:variants,id',
        'rating' => 'required|integer|between:1,5',
        'comment' => 'nullable|max:1500',
        'image_url' => 'nullable|image|max:2048',
        'bill_id' => 'required|exists:bills,id', 
    ], [
        'variant_id.required' => 'Trường variant_id là bắt buộc.',
        'variant_id.exists' => 'Mã biến thể không tồn tại.',
        'rating.required' => 'Trường đánh giá là bắt buộc.',
        'rating.integer' => 'Đánh giá phải là một số nguyên.',
        'rating.between' => 'Đánh giá phải nằm trong khoảng từ 1 đến 5.',
        'comment.max' => 'Nội dung bình luận không được vượt quá 1500 ký tự.',
        'image_url.image' => 'Tập tin phải là hình ảnh.',
        'image_url.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        'bill_id.required' => 'Trường bill_id là bắt buộc.',
        'bill_id.exists' => 'Mã đơn hàng không tồn tại.',
    ]);
    
    $imagePath = $request->file('image_url') 
        ? $request->file('image_url')->store('product-reviews', 'public') 
        : null;

    $review = ProductReview::create([
        'variant_id' => $validatedData['variant_id'],
        'user_id' => auth()->id(),
        'bill_id' => $validatedData['bill_id'], 
        'rating' => $validatedData['rating'],
        'comment' => $validatedData['comment'],
        'image_url' => $imagePath, 
        'review_date' => now(),
    ]);

    return redirect()->back()->with('success', 'Đánh giá sản phẩm thành công!');
}
}
