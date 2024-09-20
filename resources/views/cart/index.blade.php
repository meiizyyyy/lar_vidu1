@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                {{-- <h1>Giỏ Hàng</h1> --}}
                <div class="cart__list mt-5">
                    <h2 class="cart-title">Giỏ hàng của bạn <b><span
                                class="cart-total text-danger">{{ $cart->items->count() }} Sản
                                Phẩm</span> </b></h2>
                    <table class="table ">
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
                </div>
                <a href="javascript: window.history.back();" class="btn btn--large btn--outline btn-cart-continue mb-3">
                    <span class="icon-ic_left-arrow"></span>
                    Tiếp tục mua hàng
                </a>
            </div>

            <div class="col-lg-4 cart-summary">
                <h3>Tổng tiền giỏ hàng</h3>
                <div class="cart-summary__item d-flex justify-content-between">
                    <p>Tổng sản phẩm:</p>
                    <p class="total-product">{{ $cart->items->count() }}</p>
                </div>
                <div class="cart-summary__item  d-flex justify-content-between">
                    <p>Tổng tiền hàng:</p>
                    <p class="total-not-discount">{{ number_format($totalCart, 2) }} VNĐ</p>
                </div>
                <div class="cart-summary__item  d-flex justify-content-between">
                    <p>Khuyến mãi:</p>
                    {{-- <p class="total-not-discount">{{ number_format($totalCart, 2) }} VNĐ</p> --}}
                </div>
                <div class="cart-summary__item  d-flex justify-content-between">
                    <p>Thành tiền:</p>
                    <p><b class="order-price-total">{{ number_format($totalCart, 2) }} VNĐ</b></p>
                </div>
                {{-- <div class="cart-summary__button">
                    <a href="{{ route('checkout') }}" class="btn btn--large" id="purchase-step-1">Đặt hàng</a>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
