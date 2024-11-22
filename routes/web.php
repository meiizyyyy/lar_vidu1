<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Models\Product;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('home.home');
});

// Route cho trang chính
Route::get('/', [HomeController::class, 'index'])->name('home');


// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.admindashboard');
    })->name('dashboard');
    // Category Routes
    Route::get('categories', [AdminController::class, 'indexCategories'])->name('categories.index');
    Route::get('categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::post('categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('categories/{id}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    // Product Routes
    Route::get('products', [AdminController::class, 'indexProducts'])->name('products.index');
    Route::get('products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('products/{id}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    //Order Routes

    Route::get('orders', [OrderController::class, 'adminIndex'])->name('orders.index'); // Xem danh sách đơn hàng
    Route::get('orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit'); // Sửa đơn hàng
    Route::put('orders/{id}', [OrderController::class, 'update'])->name('orders.update'); // Cập nhật đơn hàng
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Xóa đơn hàng
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index'); // Hiển thị danh sách đơn hàng
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show'); // Hiển thị chi tiết đơn hàng cho admin
    Route::get('admin/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus'); // Cập nhật trạng thái đơn hàng

    //Report
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});


// Routes công khai
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Cart routes (Chỉ khi người dùng đã đăng nhập)
Route::middleware('auth')->group(function () {
    // Giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Hiển thị giỏ hàng
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add'); // Thêm sản phẩm vào giỏ hàng
    Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update'); // Cập nhật số lượng sản phẩm
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove'); // Xóa sản phẩm khỏi giỏ hàng
    // Đặt hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); // Xem danh sách đơn hàng
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show'); // Xem chi tiết đơn hàng của khách hàng
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store'); // Đặt hàng
});
Route::resource('orders', OrderController::class);





Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
