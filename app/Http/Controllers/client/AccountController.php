<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\DeleteOldPasswordResetTokens;
use App\Jobs\DeleteUserAfterTimeout;
use App\Mail\forgotPassword;
use App\Mail\verifyAccount;
use Illuminate\Support\Str;
use App\Models\PasswordResetToken;
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

    public function verify_account($email)
    {
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


    public function forgot_password()
    {
        return view('client.account-forgot-password');
    }

    // 001

   public function check_forgot_password(Request $request)
{
    // Xác thực input
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    // Tìm người dùng theo email
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

    // Lên lịch job để xóa token cũ sau 5 phút
    DeleteOldPasswordResetTokens::dispatch()->delay(now()->addMinutes(5));

    return redirect()->back()->with('message', 'Vui lòng kiểm tra email để tiếp tục!');
}

public function reset_password($token)
{
    $tokenData = PasswordResetToken::where('token', $token)->firstOrFail();

    // Kiểm tra xem token có còn hiệu lực không (trong 5 phút)
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
}
