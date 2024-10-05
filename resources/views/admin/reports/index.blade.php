@extends('layouts.app')

@section('title', 'Báo cáo')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Báo cáo Doanh Thu</h1>
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="report-box bg-primary text-white p-3 rounded shadow">
                    <h5 class="mb-2">Tổng số đơn hàng</h5>
                    <h3 class="display-5">{{ $totalOrders }}</h3>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="report-box bg-danger text-white p-3 rounded shadow">
                    <h5 class="mb-2">Tổng số khách hàng</h5>
                    <h3 class="display-5">{{ $totalCustomers }}</h3>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="report-box bg-secondary text-white p-3 rounded shadow">
                    <h5 class="mb-2">Tổng doanh thu</h5>
                    <h3 class="display-5">{{ number_format($totalRevenue, 0) }} VND</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="list-group mb-4">
                    <a href="#category" class="list-group-item list-group-item-action active" data-toggle="pill">Theo Danh
                        Mục</a>
                    <a href="#date" class="list-group-item list-group-item-action" data-toggle="pill">Theo Ngày</a>
                    <a href="#month" class="list-group-item list-group-item-action" data-toggle="pill">Theo Tháng</a>
                    <a href="#year" class="list-group-item list-group-item-action" data-toggle="pill">Theo Năm</a>
                    <a href="#payment" class="list-group-item list-group-item-action" data-toggle="pill">Theo Phương thức
                        Thanh toán</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content">
                    <div id="category" class="tab-pane fade show active">
                        <h3 class="mt-4">Doanh thu theo từng danh mục</h3>
                        <div class="row">
                            @foreach ($categoryRevenue as $revenue)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Danh mục: {{ $revenue->category_name }}</h5>
                                            <p class="card-text">Tổng doanh thu:
                                                {{ number_format($revenue->total_revenue, 0) }} VND</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="date" class="tab-pane fade">
                        <h3 class="mt-4">Doanh thu theo ngày</h3>
                        <table class="table table-striped mb-4">
                            <thead class="thead-light">
                                <tr>
                                    <th>Ngày</th>
                                    <th>Tổng doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($revenueByDate as $revenue)
                                    <tr>
                                        <td>{{ $revenue->date }}</td>
                                        <td>{{ number_format($revenue->total_revenue, 0) }} VND</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="month" class="tab-pane fade">
                        <h3 class="mt-4">Doanh thu theo tháng</h3>
                        <table class="table table-striped mb-4">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tháng/Năm</th>
                                    <th>Tổng doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($revenueByMonth as $revenue)
                                    <tr>
                                        <td>{{ $revenue->month }}/{{ $revenue->year }}</td>
                                        <td>{{ number_format($revenue->total_revenue, 0) }} VND</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="year" class="tab-pane fade">
                        <h3 class="mt-4">Doanh thu theo năm</h3>
                        <table class="table table-striped mb-4">
                            <thead class="thead-light">
                                <tr>
                                    <th>Năm</th>
                                    <th>Tổng doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($revenueByYear as $revenue)
                                    <tr>
                                        <td>{{ $revenue->year }}</td>
                                        <td>{{ number_format($revenue->total_revenue, 0) }} VND</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="payment" class="tab-pane fade">
                        <h3 class="mt-4">Doanh thu theo phương thức thanh toán</h3>
                        <table class="table table-striped mb-4">
                            <thead class="thead-light">
                                <tr>
                                    <th>Phương thức Thanh toán</th>
                                    <th>Tổng doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($revenueByPaymentMethod as $revenue)
                                    <tr class="payment-method" data-method="{{ $revenue->payment_method }}">
                                        <td>{{ $revenue->payment_method }}</td>
                                        <td>{{ number_format($revenue->total_revenue, 0) }} VND</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div id="order-details" class="mt-4"></div> <!-- Phần để hiển thị danh sách đơn hàng -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.payment-method').forEach(row => {
            row.addEventListener('click', function() {
                const paymentMethod = this.dataset.method;
                const orders = @json($ordersByPaymentMethod);

                let orderDetailsHtml = '<h5>Danh sách đơn hàng:</h5><ul>';
                (orders[paymentMethod] || []).forEach(order => {
                    orderDetailsHtml +=
                        `<li>Đơn hàng ID: ${order.id} - Tổng: ${order.total} VND</li>`;
                });
                orderDetailsHtml += '</ul>';

                document.getElementById('order-details').innerHTML = orderDetailsHtml;
            });
        });
    </script>
@endsection
