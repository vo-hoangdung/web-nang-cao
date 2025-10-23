<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Lấy dữ liệu giỏ hàng từ session (nếu có)
        $cart = session('cart', []);

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Trả về view checkout
        return view('user.checkout', compact('cart', 'total'));
    }
}
