@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Quản lý Đơn Hàng</h1>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên Tài Khoản</th>
                        <th>Khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th>Phương thức thanh toán</th>
                        <th>Ngày đặt hàng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->username }}</td>
                            <td>{{ $order->name }}</td>
                            <td>
                                <span
                                    class="badge-{{ $order->status == 'paid' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="custom-select" onchange="this.form.submit()">
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                            Processing</option>
                                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid
                                        </option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </form>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem chi
                                    tiết</a>

                                {{-- <a href="{{ route('admin.orders.edit', $order->id) }}"
                                    class="btn btn-warning btn-sm">Sửa</a> --}}
                                {{-- <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
