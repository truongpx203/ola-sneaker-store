<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index(){
        $productReview = ProductReview::with(['user', 'variant.product'])->orderBy('id', 'desc')->paginate(10);
        return view('admin.productReview.index', compact('productReview'));
    }

    public function update($reviewId){

        $productReview = ProductReview::find($reviewId);

        if ($productReview) {
            if ($productReview->is_hidden) {
                $productReview->is_hidden = false;
            }
            else{
                $productReview->is_hidden = true;
            }
            $productReview->save();
        }
        return back();
    }

}
