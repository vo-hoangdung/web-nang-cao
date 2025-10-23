<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Kiểm tra quyền truy cập của user
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Nếu chưa đăng nhập → chuyển về login
        if (!Auth::check()) {
    return redirect()->route('login');
}

if (Auth::user()->role !== $role) {
    abort(403, ' Bạn không có quyền truy cập vào trang này.');
}

        return $next($request);
    }
}
