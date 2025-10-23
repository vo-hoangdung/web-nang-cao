<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Hiển thị danh sách món ăn + lọc theo danh mục
     */
    public function index(Request $request)
    {
        $query = Food::query();

        // Lọc theo danh mục nếu có
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $foods = $query->get();

        // Danh mục có sẵn
        $categories = ['Cơm', 'Nước', 'Phở', 'Đồ ăn nhanh', 'Khác'];

        return view('foods.index', compact('foods', 'categories'));
    }

    /**
     * Hiển thị form thêm món ăn
     */
    public function create()
    {
        $categories = ['Cơm', 'Nước', 'Phở', 'Đồ ăn nhanh', 'Khác'];
        return view('foods.create', compact('categories'));
    }

    /**
     * Lưu món ăn mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category'    => 'nullable|string|max:255',
            'new_category'=> 'nullable|string|max:255',
        ]);
        $category = $request->filled('new_category') ? $request->new_category : $request->category;
        // Lưu ảnh nếu có
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('foods', 'public')
            : null;

        Food::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category'    => $category,
            'image'       => $imagePath,
        ]);

        return redirect()->route('foods.index')->with('success', 'Thêm món ăn thành công!');
    }

    /**
     * Hiển thị form sửa món ăn
     */
    public function edit(Food $food)
    {
        $categories = ['Cơm', 'Nước', 'Phở', 'Đồ ăn nhanh', 'Khác'];
        return view('foods.edit', compact('food', 'categories'));
    }

    /**
     * Cập nhật thông tin món ăn
     */
    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category'    => 'nullable|string|max:255',
            'new_category'=> 'nullable|string|max:255',
        ]);

        $category = $request->filled('new_category') ? $request->new_category : $request->category;

        $data = [
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category'    => $category,
        ];

        // Nếu có ảnh mới
        if ($request->hasFile('image')) {
            if ($food->image) {
                Storage::disk('public')->delete($food->image);
            }
            $data['image'] = $request->file('image')->store('foods', 'public');
        }

        $food->update($data);

        return redirect()->route('foods.index')->with('success', 'Cập nhật món ăn thành công!');
    }

    /**
     * Xóa món ăn
     */
    public function destroy(Food $food)
    {
        if ($food->image) {
            Storage::disk('public')->delete($food->image);
        }

        $food->delete();

        return redirect()->route('foods.index')->with('success', 'Xóa món ăn thành công!');
    }
}
