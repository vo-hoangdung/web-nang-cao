<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class UserFoodController extends Controller
{
    public function index(Request $request)
    {
        $query = Food::query();

        // --- Danh sách danh mục cố định ---
        $categories = ['Cơm', 'Nước', 'Phở', 'Đồ ăn nhanh', 'Khác'];

        // --- Tìm kiếm theo tên ---
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // --- Lọc theo danh mục ---
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // --- Lấy dữ liệu (sắp xếp mới nhất lên đầu) ---
        $foods = $query->orderByDesc('created_at')->get();

        return view('user.menu', compact('foods', 'categories'));
    }
}
