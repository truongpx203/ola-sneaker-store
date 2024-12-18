<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\ReplyContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //


    // Hiển thị danh sách liên hệ
    public function index()
    {
        $contacts = Contact::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    // Hiển thị chi tiết liên hệ
    public function show(Contact $contact, $id)
    {
        $contact = Contact::with('user')->findOrFail($id); //  Tải thông tin người dùng liên quan
        return view('admin.contacts.show', compact('contact'));
    }

    // Phản hồi liên hệ
    public function reply(Request $request, Contact $contact)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ], [
            'reply_message.required' => 'Vui lòng nhập nội dung phản hồi.',
            'reply_message.string' => 'Nội dung phản hồi phải là chuỗi ký tự.',
        ]);

        // Gửi email phản hồi tới người đã gửi liên hệ
        try {
            // Lấy email người liên hệ (từ Contact)
            $userEmail = $contact->user->email;

            // Gửi email phản hồi tới người dùng
            Mail::to($userEmail)->send(new ReplyContact($contact, $request->reply_message));

            // Gửi email cho admin (có thể không cần thiết nếu chỉ gửi cho người dùng)
            // $adminEmails = \App\Models\User::where('role', 'admin')->pluck('email')->toArray();
            // if (!empty($adminEmails)) {
            //     Mail::to($adminEmails)->send(new ReplyContact($contact, $request->reply_message));
            // }

            // Đánh dấu liên hệ đã được phản hồi
            $contact->update(['is_resolved' => true]);

            // Trả về thông báo thành công
            return redirect()->route('contacts.index')->with('success', 'Phản hồi đã được gửi thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi trong quá trình gửi email, ghi lại lỗi và trả về thông báo lỗi
            \Log::error('Error sending reply email: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi gửi email phản hồi. Vui lòng thử lại sau.');
        }
    }


    // Xóa liên hệ
    // public function destroy($id)
    // {
    //     $contact = Contact::findOrFail($id); // Tìm liên hệ theo ID
    //     $contact->delete(); // Xóa liên hệ
    //     return redirect()->route('contacts.index')->with('success', 'Liên hệ đã được xóa thành công.');
    // }
}
