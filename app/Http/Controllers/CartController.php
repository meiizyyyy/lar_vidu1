<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        // Lấy giỏ hàng của người dùng hiện tại
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();
        return view('cart.index', compact('cart'));
    }

    // Thêm sản phẩm vào giỏ hàng

    public function add(Request $request, $productId)
    {
        // Tìm hoặc tạo giỏ hàng cho người dùng
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có, tăng số lượng
            $cartItem->increment('quantity');
        } else {
            // Nếu không, tạo mới một item trong giỏ hàng
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => 1, // Giá trị mặc định là 1
                'cart_id' => $cart->id, // Gán giá trị cart_id
            ]);
        }

        // Tìm sản phẩm để trả về tên
        $product = $cart->items()->with('product')->where('product_id', $productId)->first();

        return response()->json(['product_name' => $product->product->name]);
    }





    // Thay đổi số lượng sản phẩm
    public function update(Request $request, $itemId)
    {
        $cartItem = CartItem::where('cart_item_id', $itemId)->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            return redirect()->route('cart.index')->with('success', 'Số lượng sản phẩm đã được cập nhật!');
        }

        return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }
    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($itemId)
    {
        $cartItem = CartItem::where('cart_item_id', $itemId)->first(); // Sử dụng cart_item_id

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        }

        return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }
}
