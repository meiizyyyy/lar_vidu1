<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Xóa tất cả người dùng hiện tại (nếu cần)
        User::truncate();

        // Tạo tài khoản admin
        User::create([
            'first_name' => 'Duc',
            'last_name' => 'Dang Hoang',
            'email' => 'ducdanghoang96@gmail.com',
            'username' => 'adminuser',
            'password' => Hash::make('meiizyyyy'), // Đảm bảo mật khẩu được mã hóa
            'role' => 'admin', // Đặt role là admin
        ]);
    }
}
