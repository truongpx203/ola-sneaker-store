<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Kiểm tra trạng thái tài khoản
            if ($user->status == 'inactive') {
                Auth::logout(); 
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
            }

            // Nếu tài khoản hoạt động, tiếp tục
            return $next($request);
        }

        return redirect()->route('login');
    }
}
