@extends('layouts.app')

@section('content')
    <div class="container mt-lg-5">
        <h1 class="mb-4">Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quản lý Đơn Hàng</h5>
                        <p class="card-text">Xem và xử lý các đơn hàng của khách hàng.</p>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Quản lý Đơn Hàng</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quản lý Sản Phẩm</h5>
                        <p class="card-text">Xem và quản lý các sản phẩm trên hệ thống.</p>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quản lý Sản Phẩm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quản lý Danh Mục</h5>
                        <p class="card-text">Xem và quản lý các danh mục sản phẩm.</p>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Quản lý Danh Mục</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Báo Cáo</h5>
                        <p class="card-text">Xem và quản lý thống kê báo cáo.</p>
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-primary">Báo cáo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
