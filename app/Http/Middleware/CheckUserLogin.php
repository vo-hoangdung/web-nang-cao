<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLogin
{
    /**
     * Kiểm tra người dùng đã đăng nhập chưa.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập trước khi truy cập!');
        }

        return $next($request);
    }
}
