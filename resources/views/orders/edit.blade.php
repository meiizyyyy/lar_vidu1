@extends('layouts.app')

@section('content')
    <h1>Sửa Đơn Hàng #{{ $order->id }}</h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Họ tên</label>
            <input type="text" name="name" value="{{ $order->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" value="{{ $order->phone }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email (không bắt buộc)</label>
            <input type="email" name="email" value="{{ $order->email }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <textarea name="address" class="form-control" required>{{ $order->address }}</textarea>
        </div>

        <div class="form-group">
            <label for="notes">Ghi chú</label>
            <textarea name="notes" class="form-control">{{ $order->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Xóa đơn hàng</button>
    </form>
@endsection
