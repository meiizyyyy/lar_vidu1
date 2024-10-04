@extends('layouts.app')

@section('content')
    <div class="container mt-lg-5">
        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>
        <p>Ngày đặt hàng: {{ $order->created_at }}</p>
        <p>Trạng thái: {{ $order->status }}</p>
        <p>Tổng số tiền: {{ number_format($order->total, 0, ',', '.') }} VNĐ</p>

        <h3>Thông tin giao hàng</h3>
        <p>Tên: {{ $order->name }}</p>
        <p>Số điện thoại: {{ $order->phone }}</p>
        <p>Email: {{ $order->email }}</p>
        <p>Địa chỉ: {{ $order->address }}</p>

        <h3>Chi tiết sản phẩm</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
