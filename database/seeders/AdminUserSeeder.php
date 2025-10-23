<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Nếu chưa có admin nào, tạo mặc định
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'username' => 'Admin',
                'name'     => 'Administrator',
                'email'    => 'admin@example.com',
                'password' => Hash::make('123456'), 
                'role'     => 'admin',
            ]);
        }
    }
}
