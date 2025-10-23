<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserFoodController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckUserLogin;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\CheckoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Trang mặc định → chuyển hướng đến login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🧠 Đăng ký / Đăng nhập / Đăng xuất
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// 🛡️ Các route cần đăng nhập
Route::middleware([CheckUserLogin::class])->group(function () {

    // 🧾 Trang menu cho người dùng (khách hàng)
    Route::get('/menu', [UserFoodController::class, 'index'])->name('user.menu');

    // 🛒 Giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    // 🧑‍💼 Chỉ admin mới được CRUD món ăn
    Route::middleware([CheckAdmin::class])->group(function () {
        Route::resource('foods', FoodController::class);
    });
});
