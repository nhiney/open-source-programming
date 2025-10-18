<?php

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem user đã đăng nhập chưa
        if (!Auth::check()) { // Use Auth facade
            return redirect()->route('login')
                ->with(
                    'error',
                    'Vui lòng đăng nhập để truy cập trang quản trị.'
                );
        }
        // Kiểm tra quyền admin
        if (!Auth::user()->is_admin) { // Use Auth facade
            return redirect()->route('posts.index')
                ->with('error', 'Bạn không có quyền truy cập trang quản trị.');
        }
        return $next($request);
    }
}
