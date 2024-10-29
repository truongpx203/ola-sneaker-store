<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
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
            $role = $user->role;
            $status = $user->status;

            if ($status == 'inactive') {
                Auth::logout(); 
                return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
            }

            // Kiểm tra vai trò
            if ($role == 'admin') {
                return $next($request); 
            } elseif ($role == 'user') {
                return redirect()->route('account'); 
            } else {
                return redirect()->route('error.page'); 
            }
        }

        return redirect()->route('login'); 
    }
}
