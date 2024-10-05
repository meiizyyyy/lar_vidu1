<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng của người dùng
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }


    // Xử lý đặt hàng
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'notes' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        // Lấy giỏ hàng hiện tại của người dùng
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn trống.');
        }

        // Tạo đơn hàng
        $order = Order::create([

            'user_id' => auth()->id(),
            'total' => $cart->items->sum(fn($item) => $item->quantity * $item->product->price),
            'status' => 'processing',
            'payment_method' => $request->input('payment_method'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'notes' => $request->input('notes'),
        ]);

        // Tạo các sản phẩm trong đơn hàng
        foreach ($cart->items as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $order->payment_method,
        ]);
        // Xóa giỏ hàng sau khi đặt hàng
        $cart->items()->delete();
        $cart->delete();

        return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công!');
    }



    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->only('name', 'phone', 'email', 'address', 'notes'));

        return redirect()->route('orders.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }


    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Kiểm tra nếu đơn hàng có thể bị xóa (nếu cần)
        if ($order->status == 'processing') {
            $order->delete();
            return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa!');
        } else {
            return redirect()->route('orders.index')->with('error', 'Không thể xóa đơn hàng này.');
        }
    }

    public function show($id)
    {
        // Lấy đơn hàng của người dùng đã đăng nhập
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->with('orderItems.product') // Lấy các sản phẩm trong đơn hàng
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    //Admin
    // public function adminIndex()
    // {
    //     // Chỉ lấy đơn hàng của tất cả người dùng
    //     $orders = Order::all();
    //     return view('admin.orders.index', compact('orders'));
    // }
}
