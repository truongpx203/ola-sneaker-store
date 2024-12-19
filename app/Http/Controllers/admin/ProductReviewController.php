<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductReview::with(['user', 'variant.product', 'variant.size'])->orderBy('id', 'desc');

        if ($request->filled('product_name')) {
            $query->whereHas('variant.product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product_name . '%');
            });
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('review_date')) {
            $query->whereDate('review_date', $request->review_date);
        }

        $productReview = $query->paginate(10);

        return view('admin.productReview.index', compact('productReview'));
    }


    public function update($reviewId)
    {

        $productReview = ProductReview::find($reviewId);

        if ($productReview) {
            if ($productReview->is_hidden) {
                $productReview->is_hidden = false;
            } else {
                $productReview->is_hidden = true;
            }
            $productReview->save();
        }
        return back()->with('success', 'Cập nhật thành công!');
    }
}
