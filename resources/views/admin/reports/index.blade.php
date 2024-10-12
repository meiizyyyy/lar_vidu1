@extends('layouts.app')

@section('title', 'Báo cáo')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Báo cáo Doanh Thu</h1>

        <!-- Các báo cáo tổng quan -->
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
                        <canvas id="categoryChart"></canvas>
                    </div>

                    <div id="date" class="tab-pane fade">
                        <h3 class="mt-4">Doanh thu theo ngày</h3>
                        <canvas id="dateChart"></canvas>
                    </div>

                    <div id="month" class="tab-pane fade">
                        <h3 class="mt-4">Doanh thu theo tháng</h3>
                        <canvas id="monthChart"></canvas>
                    </div>

                    <div id="year" class="tab-pane fade">
                        <h3 class="mt-4">Doanh thu theo năm</h3>
                        <canvas id="yearChart"></canvas>
                    </div>

                    <div id="payment" class="tab-pane fade">
                        <h3 class="mt-4">Doanh thu theo phương thức thanh toán</h3>
                        <canvas id="paymentChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Biểu đồ doanh thu theo danh mục
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: @json($categoryRevenue->pluck('category_name')),
                datasets: [{
                    label: 'Doanh thu',
                    data: @json($categoryRevenue->pluck('total_revenue')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ doanh thu theo ngày
        const dateCtx = document.getElementById('dateChart').getContext('2d');
        const dateChart = new Chart(dateCtx, {
            type: 'line',
            data: {
                labels: @json($revenueByDate->pluck('date')),
                datasets: [{
                    label: 'Doanh thu',
                    data: @json($revenueByDate->pluck('total_revenue')),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ doanh thu theo tháng
        const monthCtx = document.getElementById('monthChart').getContext('2d');
        const monthChart = new Chart(monthCtx, {
            type: 'bar',
            data: {
                labels: @json(
                    $revenueByMonth->map(function ($item) {
                        return $item->month . '/' . $item->year;
                    })),
                datasets: [{
                    label: 'Doanh thu',
                    data: @json($revenueByMonth->pluck('total_revenue')),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ doanh thu theo năm
        const yearCtx = document.getElementById('yearChart').getContext('2d');
        const yearChart = new Chart(yearCtx, {
            type: 'bar',
            data: {
                labels: @json($revenueByYear->pluck('year')),
                datasets: [{
                    label: 'Doanh thu',
                    data: @json($revenueByYear->pluck('total_revenue')),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ doanh thu theo phương thức thanh toán
        const paymentCtx = document.getElementById('paymentChart').getContext('2d');
        const paymentChart = new Chart(paymentCtx, {
            type: 'pie',
            data: {
                labels: @json($revenueByPaymentMethod->pluck('payment_method')),
                datasets: [{
                    label: 'Doanh thu',
                    data: @json($revenueByPaymentMethod->pluck('total_revenue')),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,

                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
@endsection
