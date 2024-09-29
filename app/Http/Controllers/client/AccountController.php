<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login()
    {
        return view('client.account-login');
    }

    public function register()
    {
        return view('client.account-register');
    }

    public function account()
    {
        return view('client.account');
    }

    // Đăng ký
    public function registerSubmit(RegisterRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return redirect()->route('login')->with('message', 'Đăng ký tài khoản thành công');
    }

    // đăng nhập

    public function loginSubmit(Request $request)
    {
        $request->only(['email', 'password']);

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:16',
        ]
        , [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Vui lòng nhập một địa chỉ email hợp lệ.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 16 ký tự.',
        ]);

        // Kiểm tra tên đăng nhập và mật khẩu
        if (Auth::attempt($validatedData)) {
            // Kiểm tra trạng thái active của tài khoản
            if (Auth::user()->status == 'active') {
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
