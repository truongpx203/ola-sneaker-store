<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login(){
        return view('client.account-login');
    }

     public function register(){
        return view('client.account-register');
    }

    public function account(){
        return view('client.account');
    }

    // Đăng ký
    public function registerSubmit(Request $request)
    {

        $validatedData = $request->validate([
            'fullname' => 'required|max:255',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = User::create($validatedData);

        return redirect()->route('login')->with('message', 'Đăng ký tài khoản thành công');
    }

     // đăng nhập

     public function loginSubmit(Request $request)
     {
         $request->only(['username', 'password']);
 
         $validatedData = $request->validate([
             'username' => 'required',
             'password' => 'required|min:8',
         ]);
 
         // Kiểm tra tên đăng nhập và mật khẩu
         if (Auth::attempt($validatedData)) {
             // Kiểm tra trạng thái active của tài khoản
             if (Auth::user()->active == 1) {
                 $request->session()->regenerate();
 
                 // Kiểm tra vai trò của người dùng
                 if (Auth::user()->role == 'admin') {
                     return redirect()->route('dashboard');
                 } else {
                     return redirect()->route('account');
                 }
             } else {
                 // Tài khoản không active
                 Auth::logout();
                 return redirect()->back()->with('error', 'Tài khoản của bạn đã bị khóa.');
             }
         } else {
             return redirect()->back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
         }
     }
 
     public function logout()
     {
         Auth::logout();
         return redirect()->route('login');
     }

}
