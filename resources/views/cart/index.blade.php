@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart__list mt-3">
                    @if ($cart && $cart->items->isNotEmpty())
                        <h2 class="cart-title">Giỏ hàng của bạn <b><span
                                    class="cart-total text-danger">{{ $cart->items->count() }} Sản
                                    Phẩm</span> </b></h2>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Tên Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalCart = 0; @endphp
                                @foreach ($cart->items as $item)
                                    @php
                                        $totalPrice = $item->product->price * $item->quantity;
                                        $totalCart += $totalPrice;
                                    @endphp
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . $item->product->image_url) }}"
                                                alt="{{ $item->product->name }}" width="100">
                                            {{ $item->product->name }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.update', $item->cart_item_id) }}" method="POST">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" style="width: 60px;">
                                                <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                            </form>
                                        </td>
                                        <td>{{ number_format($totalPrice, 2) }} VNĐ</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h2 class="cart-title text-danger">Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm.</h2>
                    @endif
                </div>
                {{-- <a href="javascript: window.history.back();" class="btn btn--large btn--outline btn-cart-continue mb-3">
                    <span class="icon-ic_left-arrow"></span>
                    Tiếp tục mua hàng
                </a> --}}
            </div>

            <div class="col-lg-4 cart-summary">
                <h3>Tổng tiền giỏ hàng</h3>
                @if ($cart && $cart->items->isNotEmpty())
                    <div class="cart-summary__item d-flex justify-content-between">
                        <p>Tổng sản phẩm:</p>
                        <p class="total-product">{{ $cart->items->count() }}</p>
                    </div>
                    <div class="cart-summary__item d-flex justify-content-between">
                        <p>Tổng tiền hàng:</p>
                        <p class="total-not-discount">{{ number_format($totalCart, 2) }} VNĐ</p>
                    </div>
                    <div class="cart-summary__item d-flex justify-content-between">
                        <p>Khuyến mãi:</p>
                        {{-- <p class="total-not-discount">{{ number_format($totalCart, 2) }} VNĐ</p> --}}
                    </div>
                    <div class="cart-summary__item d-flex justify-content-between">
                        <p>Thành tiền:</p>
                        <p><b class="order-price-total">{{ number_format($totalCart, 2) }} VNĐ</b></p>
                    </div>

                    {{-- Thêm form đặt hàng --}}
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ tên:</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required
                                value="{{ auth()->user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ giao hàng:</label>
                            <textarea name="address" id="address" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="notes">Ghi chú:</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Chọn phương thức thanh toán:</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="COD">Thanh toán khi nhận hàng (COD)</option>
                                <option value="online">Thanh toán online</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-3">Đặt hàng</button>
                    </form>
                @else
                    <p class="text-danger">Không có thông tin để hiển thị tổng tiền.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
