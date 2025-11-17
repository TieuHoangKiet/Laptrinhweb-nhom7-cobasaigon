<?php
// app/Http/Middleware/EnsureUserIsAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            // Có thể trả về lỗi 403 hoặc redirect về trang login
            // abort(403, 'Bạn cần đăng nhập để thực hiện hành động này.');
            return redirect()->route('login'); // Redirect về trang đăng nhập
        }

        $user = Auth::user();

        // Kiểm tra nếu người dùng không phải là admin
        // Giả sử bạn có một cột 'role' trong bảng 'users'
        if ($user->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập khu vực này.');
        }

        // Nếu là admin, cho phép request tiếp tục
        return $next($request);
    }
}