<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    // Hiển thị danh sách liên hệ
    public function index()
    {
        $contacts = Contact::all(); // Lấy tất cả các liên hệ
        return view('admin.contacts.index', compact('contacts')); // Trả về view với danh sách liên hệ
    }

    // Xem chi tiết liên hệ
    public function show($id)
    {
        $contact = Contact::findOrFail($id); // Tìm liên hệ theo ID
        return view('admin.contacts.show', compact('contact')); // Hiển thị chi tiết
    }

    // Xóa liên hệ
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id); // Tìm liên hệ theo ID
        $contact->delete(); // Xóa liên hệ
        return redirect()->route('contacts.index')->with('success', 'Liên hệ đã được xóa thành công.');
    }
}
