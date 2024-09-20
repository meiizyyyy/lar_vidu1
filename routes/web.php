<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Models\Product;

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

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
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
});


// Routes công khai
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Hiển thị giỏ hàng
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add'); // Thêm sản phẩm vào giỏ hàng
    Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update'); // Cập nhật số lượng sản phẩm
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove'); // Xóa sản phẩm khỏi giỏ hàng
});

// Route cho trang chính
Route::get('/home', [HomeController::class, 'index'])->name('home');



// Hiển thị form đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

// Xử lý đăng ký người dùng
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Hiển thị form đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Xử lý đăng nhập người dùng
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Đăng xuất người dùng
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
