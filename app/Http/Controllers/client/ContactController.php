<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;
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
        // Lưu thông tin vào cơ sở dữ liệu
        $contact = Contact::create($validated);

        // Gửi email thông báo cho admin
        // Mail::send('emails.new_contact', ['contact' => $contact], function ($message) {
        //     $message->to('admin@example.com', 'Admin')
        //         ->subject('Thông báo liên hệ mới');
        // });
        // Contact::create($validated);

        return back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
    }
}
