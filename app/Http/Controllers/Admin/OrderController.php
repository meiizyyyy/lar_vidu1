<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị danh sách tất cả đơn hàng (chỉ dành cho admin)
    public function index()
    {
        $orders = Order::all(); // Lấy tất cả đơn hàng
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị chi tiết một đơn hàng
    public function show($id)
    {
        // Lấy chi tiết đơn hàng cho admin, không giới hạn user
        $order = Order::with('orderItems.product') // Lấy các sản phẩm trong đơn hàng
            ->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng (ví dụ từ "processing" sang "paid", "cancelled")
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:processing,paid,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    // Xóa một đơn hàng (nếu cần)
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã bị xóa.');
    }
}
