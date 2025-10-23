<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.cart', compact('cart'));
    }

    /**
     * Thêm món ăn vào giỏ hàng
     */
    public function add(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $cart = session()->get('cart', []);

        // Nếu món đã tồn tại thì tăng số lượng
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $food->name,
                'price' => $food->price,
                'image' => $food->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', '🛒 Đã thêm món vào giỏ hàng!');
    }

    /**
     * Cập nhật số lượng món ăn trong giỏ
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy món trong giỏ hàng!');
        }

        // Tăng hoặc giảm số lượng
        if ($request->action === 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($request->action === 'decrease') {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]); // Nếu còn 1 mà bấm trừ thì xóa khỏi giỏ
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng thành công!');
    }

    /**
     * Xóa một món ra khỏi giỏ hàng
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', '🗑️ Đã xóa món khỏi giỏ hàng!');
    }

    /**
     * Thanh toán (xóa giỏ hàng sau khi đặt)
     */
    public function checkout(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống, không thể thanh toán!');
    }

    // ✅ Lấy dữ liệu từ form
    $name = $request->input('name');
    $phone = $request->input('phone');
    $address = $request->input('address');
    $payment = $request->input('payment_method');

    // (Sau này có thể lưu vào bảng orders)
    // Order::create([...]);

    // ✅ Xóa giỏ hàng sau khi thanh toán
    session()->forget('cart');

    // ✅ Chuyển hướng về trang menu kèm thông báo
    return redirect()->route('user.menu')->with('success', '🎉 Thanh toán thành công! Cảm ơn ' . $name . ' đã đặt hàng.');
}

}


