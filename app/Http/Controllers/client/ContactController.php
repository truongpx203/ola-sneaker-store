<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactNotification;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //
    // Hiển thị form liên hệ
    public function showForm()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        return view('client.contact', compact('user')); // Hiển thị form
    }

    // Xử lý form liên hệ
    public function submitForm(ContactFormRequest $request)
    {
        // Xác thực dữ liệu
        $validated = $request->validated();

        // Kiểm tra nếu người dùng đã đăng nhập và gán user_id
        if (auth()->check()) {
            $validated['user_id'] = auth()->id(); // Gán user_id
        }

        // Lưu thông tin vào cơ sở dữ liệu
        $contact = Contact::create($validated);

        // Kiểm tra sự tồn tại của user trước khi gửi email
        if ($contact->user && $contact->user->email) {
            // Gửi email cho user hoặc admin
            Mail::to($contact->user->email)->send(new ContactNotification($contact));
        } else {
            // Gửi email thông báo cho admin nếu không có người dùng liên kết
            Mail::to('admin@example.com')->send(new ContactNotification($contact));
        }

        // Nếu có lỗi trong quá trình gửi email, trả về thông báo lỗi
        return back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.');
    }
}
