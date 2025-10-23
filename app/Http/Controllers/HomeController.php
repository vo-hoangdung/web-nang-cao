<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Trang chủ - hiển thị sản phẩm nổi bật
     */
    public function index()
    {
        // Lấy 4 sản phẩm nổi bật (có thể là sản phẩm mới nhất hoặc theo giá)
        $featuredFoods = Food::orderByDesc('created_at')->take(4)->get();
        
        return view('home', compact('featuredFoods'));
    }

    /**
     * Trang giới thiệu về cửa hàng
     */
    public function about()
    {
        return view('about');
    }
}
