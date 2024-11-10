<?php

namespace App\Http\Controllers\client;

use App\Models\User;
use App\Mail\verifyAccount;
use Illuminate\Support\Str;
use App\Mail\forgotPassword;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use App\Http\Controllers\Controller;
use App\Jobs\DeleteUserAfterTimeout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use App\Jobs\DeleteOldPasswordResetTokens;

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
        $user = Auth::user();
        $bills = $user->bills()->orderBy('id', 'desc')->get();
        return view('client.account', compact('user', 'bills'));
    }

    // Đăng ký
    public function registerSubmit(RegisterRequest $request)
{
    $data = $request->validated();

    // Tạo người dùng và kích hoạt tài khoản ngay lập tức
    $data['status'] = 'active'; // Đặt trạng thái là active
    $data['email_verified_at'] = now(); // Xác nhận email đã được xác thực

    if ($user = User::create($data)) {
        return redirect()->route('login')->with('message', 'Đăng ký tài khoản thành công.');
    }

    return redirect()->back()->with('error', 'Đã xảy ra một số lỗi!, vui lòng thử lại');
}

    // đăng nhập

    // public function loginSubmit(Request $request)
    // {
    //     $credentials = $request->only(['email', 'password']);

    //     $validatedData = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:8|max:16',
    //     ], [
    //         'email.required' => 'Email là bắt buộc.',
    //         'email.email' => 'Vui lòng nhập một địa chỉ email hợp lệ.',
    //         'password.required' => 'Mật khẩu là bắt buộc.',
    //         'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
    //         'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
    //         'password.max' => 'Mật khẩu không được vượt quá 16 ký tự.',
    //     ]);

    //     if (Auth::attempt($validatedData)) {
    //         $user = Auth::user();

    //         if ($user->status == 'pending') {
    //             Auth::logout();
    //             return redirect()->back()->with('error', 'Tài khoản của bạn chưa được xác thực.');
    //         }

    //         if ($user->status == 'inactive') {
    //             Auth::logout();
    //             return redirect()->back()->with('error', 'Tài khoản của bạn đã bị khóa.');
    //         }

    //         // Nếu tài khoản là active
    //         $request->session()->regenerate();

    //         if ($user->role == 'admin') {
    //             return redirect()->route('dashboard');
    //         } else {
    //             return redirect()->route('account');
    //         }
            
    //     } else {
    //         return redirect()->back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
    //     }
    // }
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
    
            // Không cần kiểm tra trạng thái tài khoản nữa
            $request->session()->regenerate();
    
            if ($user->role == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('account');
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


    public function forgot_password()
    {
        return view('client.account-forgot-password');
    }

    // 001

    public function check_forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Tạo token mới
        $token = Str::random(40);
        $tokenData = [
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(), // lưu thời gian tạo
        ];

        // Xóa token cũ nếu có
        PasswordResetToken::where('email', $request->email)->delete();

        // Lưu token mới vào cơ sở dữ liệu
        PasswordResetToken::create($tokenData);

        // Gửi email chứa token
        Mail::to($request->email)->send(new ForgotPassword($user, $token));


        DeleteOldPasswordResetTokens::dispatch()->delay(now()->addMinutes(5));

        return redirect()->back()->with('message', 'Vui lòng kiểm tra email để tiếp tục!');
    }

    public function reset_password($token)
    {
        $tokenData = PasswordResetToken::where('token', $token)->firstOrFail();

        if ($tokenData->created_at < now()->subMinutes(5)) {
            return redirect()->route('account.forgot_password')->with('error', 'Token đã hết hạn. Vui lòng gửi lại email.');
        }

        return view('client.reset-password', ['token' => $token]);
    }

    public function check_reset_password(Request $request, $token)
    {
        $data = $request->validate(
            [
                'password' => 'required|string|min:8|max:16',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'password.max' => 'Mật khẩu không được vượt quá 16 ký tự.',

                'password_confirmation.required' => 'Xác nhận mật khẩu là bắt buộc.',
                'password_confirmation.same' => 'Xác nhận mật khẩu không khớp với mật khẩu.',
            ]
        );
        $tokenData = PasswordResetToken::where('token', $token)->firstOrFail();
        $user = $tokenData->user;

        $check = $user->update($data);

        if ($check) {
            return redirect()->route('login')->with('message', 'Cập nhật mật khẩu thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật mật khẩu thất bại');
    }
    public function updateProfile(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'current_password' => 'required|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Update user fields
        $user->full_name = $request->full_name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        // Update password if provided
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        // Save the user
        $user->save();

        return back()->with('success', 'Thông tin đã được cập nhật thành công.');
    }
}
