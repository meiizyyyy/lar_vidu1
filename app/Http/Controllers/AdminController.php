<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Sử dụng model Category
use App\Models\Product;  // Sử dụng model Product
use App\Models\Order;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

class AdminController extends Controller
{
    //
    // Constructor để kiểm tra quyền admin
    public function __construct()
    {

        $this->middleware(['auth', 'admin']); // Kiểm tra middleware admin
    }

    public function index()
    {
        // Chức năng quản lý admin
    }

    public function indexCategories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function indexProducts()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    public function indexOrders()
    {
        $orders = Order::all(); // Lấy tất cả đơn hàng
        return view('admin.orders.index', compact('orders')); // Trả về view với danh sách đơn hàng
    }

    public function createCategory()
    {
        $categoryController = new CategoryController();
        return $categoryController->create();  // Gọi phương thức create() từ CategoryController
    }

    public function storeCategory(Request $request)
    {
        $categoryController = new CategoryController();
        return $categoryController->store($request);  // Gọi phương thức store() từ CategoryController
    }
    public function editCategory($id)
    {
        return app(CategoryController::class)->edit($id);
    }

    public function updateCategory(Request $request, $id)
    {
        return app(CategoryController::class)->update($request, $id);
    }

    public function destroyCategory($id)
    {
        return app(CategoryController::class)->destroy($id);
    }


    public function createProduct()
    {
        return app(ProductController::class)->create();
    }

    public function storeProduct(Request $request)
    {
        return app(ProductController::class)->store($request);
    }

    public function editProduct($id)
    {
        return app(ProductController::class)->edit($id);
    }

    public function updateProduct(Request $request, $id)
    {
        return app(ProductController::class)->update($request, $id);
    }

    public function destroyProduct($id)
    {
        return app(ProductController::class)->destroy($id);
    }
}
