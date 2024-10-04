<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    public function testAdminCanAccessAdminRoute()
    {
        // Lấy người dùng admin đã tồn tại
        $adminUser = User::where('role', 'admin')->first();
        $this->assertNotNull($adminUser, 'Admin user does not exist.');

        $response = $this->actingAs($adminUser)->get('/admin/categories');
        $response = $this->actingAs($adminUser)->get('/admin/products');
        $response->assertStatus(200); // Kiểm tra có thể truy cập
    }

    public function testCustomerCannotAccessAdminRoute()
    {
        // Lấy người dùng customer đã tồn tại
        $customerUser = User::where('role', 'customer')->first();
        $this->assertNotNull($customerUser, 'Customer user does not exist.');

        $response = $this->actingAs($customerUser)->get('/admin/categories');
        $response = $this->actingAs($customerUser)->get('/admin/products');
        $response->assertRedirect(route('login')); // Kiểm tra không thể truy cập
        $response->assertSessionHas('error', 'Bạn không có quyền truy cập trang này.'); // Kiểm tra thông báo lỗi
    }
}
