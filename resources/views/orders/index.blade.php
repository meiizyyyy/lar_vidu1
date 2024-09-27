@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Danh sách đơn hàng</h1>

        @if ($orders->isEmpty())
            <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
        @else
            @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">Đơn hàng #{{ $order->id }}</h3>
                        <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 2) }} VND</p>
                        <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                        <p><strong>Tên:</strong> {{ $order->name }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                        <p><strong>Ghi chú:</strong> {{ $order->notes }}</p>

                        @if ($order->status === 'processing')
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Sửa thông tin</a>

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa đơn hàng</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
