<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // Kiểm tra xem role_id của người dùng có phải là 1 (admin) hay không
            if (Auth::user()->role_id == 1) {
                return $next($request); // Cho phép truy cập vào trang admin
            }
        }

        // Nếu không phải admin hoặc chưa đăng nhập, chuyển hướng về trang login
        return redirect('/');
    }
}
