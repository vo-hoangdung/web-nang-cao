<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegister()
    {
        return view('user.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name ?? $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    //Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('user.login');
    }

    // đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user', $user);
            if ($user->role === 'admin') {
                return redirect()->route('foods.index');
            }
            return redirect()->route('home');
        }

        return back()->with('error', 'Sai email hoặc mật khẩu!');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }
}
