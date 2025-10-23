<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Middleware kiểm tra quyền admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->session()->get('user');

        // Kiểm tra nếu chưa đăng nhập hoặc không phải admin
        if (!$user || (isset($user['role']) && $user['role'] !== 'admin')) {
            return redirect()
                ->route('user.menu')
                ->with('error', 'Bạn không có quyền truy cập trang quản trị!');
        }

        return $next($request);
    }
}
