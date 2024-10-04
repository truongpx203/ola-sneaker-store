<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\DeleteUserAfterTimeout;
use App\Mail\verifyAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    
        // Tạo người dùng và ghi thời gian gửi email xác thực
        if ($user = User::create($data)) {
            $user->email_verification_sent_at = now(); // Ghi thời gian gửi email
            $user->save();
    
            // Gửi email xác thực
            Mail::to($user->email)->send(new VerifyAccount($user));
    
            DeleteUserAfterTimeout::dispatch($user)->delay(now()->addMinutes(5));
    
            return redirect()->route('login')->with('message', 'Đăng ký tài khoản thành công, vui lòng kiểm tra email để xác minh tài khoản');
        }
        
        return redirect()->back()->with('error', 'Đã xảy ra một số lỗi!, vui lòng thử lại');
    }

    public function verify_account($email){
        $user = User::where('email', $email)->whereNULL('email_verified_at')->firstOrFail();
        $user->email_verified_at = now();
        $user->status = 'active'; 
        $user->save(); 
        return redirect()->route('login')->with('message', 'Xác thực tài khoản thành công');
    }

    // đăng nhập

    public function loginSubmit(Request $request)
{
    $credentials = $request->only(['email', 'password']);

    $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8|max:16',
    ], [
        'email.required' => 'Email là bắt buộc.',
        'email.email' => 'Vui lòng nhập một địa chỉ email hợp lệ.',
        'password.required' => 'Mật khẩu là bắt buộc.',
        'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        'password.max' => 'Mật khẩu không được vượt quá 16 ký tự.',
    ]);

    if (Auth::attempt($validatedData)) {
        $user = Auth::user();

        if ($user->status == 'pending') {
            Auth::logout();
            return redirect()->back()->with('error', 'Tài khoản của bạn chưa được xác thực.');
        }

        if ($user->status == 'active') {
            $request->session()->regenerate();

            // Kiểm tra vai trò của người dùng
            if ($user->role == 'admin') {
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
