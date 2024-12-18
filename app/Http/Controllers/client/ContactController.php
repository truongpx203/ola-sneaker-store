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
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để liên hệ.');
        }    

        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        return view('client.contact', compact('user')); // Hiển thị form
    }

    // Xử lý form liên hệ
    public function submitForm(ContactFormRequest $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để gửi liên hệ.');
        }

        // Xác thực dữ liệu
        $validated = $request->validated();

        // Gán user_id của người dùng vào dữ liệu contact
        $validated['user_id'] = Auth::id(); 

        // Lưu thông tin vào cơ sở dữ liệu
        $contact = Contact::create($validated);

        // Gửi email thông báo cho admin 
        try {
            // Lấy danh sách email của admin từ cơ sở dữ liệu
            $adminEmails = \App\Models\User::where('role', 'admin')->pluck('email')->toArray();

            // Nếu có admin, gửi email
            if (!empty($adminEmails)) {
                Mail::to($adminEmails)->send(new ContactNotification($contact));
            }

            // Trả về thông báo thành công
            return back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.');
        } catch (\Exception $e) {
            // Nếu có lỗi trong quá trình gửi email, trả về thông báo lỗi
            \Log::error('Error sending contact email: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi gửi email. Vui lòng thử lại sau.');
        }
    }
}
