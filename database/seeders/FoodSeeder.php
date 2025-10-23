<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            [
                'name' => 'Cơm Gà Xối Mỡ',
                'description' => 'Cơm gà giòn rụm, thơm ngon, ăn kèm nước mắm tỏi ớt.',
                'price' => 60000,
                'image' => 'foods/com-ga.jpg',
                'category_id' => 1, // Cơm
                'category' => 'Cơm',
            ],
            [
                'name' => 'Bún Bò Huế',
                'description' => 'Hương vị đậm đà của xứ Huế với thịt bò và chả.',
                'price' => 55000,
                'image' => 'foods/bun-bo.jpg',
                'category_id' => 2, // Bún
                'category' => 'Phở',
            ],
            [
                'name' => 'Trà Tắc',
                'description' => 'Đồ uống mát lạnh, chua ngọt tự nhiên.',
                'price' => 20000,
                'image' => 'foods/tra-tac.jpg',
                'category_id' => 3, // Nước uống
                'category' => 'Nước',
            ],
            [
                'name' => 'Chè Ba Màu',
                'description' => 'Món tráng miệng truyền thống với đậu, nước cốt dừa và thạch.',
                'price' => 25000,
                'image' => 'foods/che-ba-mau.jpg',
                'category_id' => 4, // Tráng miệng
                'category' => 'Khác',
            ],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
