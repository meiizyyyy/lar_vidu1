<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> <!-- Liên kết đến file CSS tùy chỉnh -->

</head>

<body>
    <div class="container mt-5 ">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Laravel PHP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        {{-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li> --}}
                        <!-- Link cho tất cả user (công khai) -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">Category List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Product List</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <!-- Link cho admin -->
                        @if (auth()->check() && auth()->user()->role == 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin Menu
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Admin
                                            Category List</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Admin
                                            Product List</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">Admin Order
                                            Management</a></li>
                                </ul>
                            </li>
                        @endif

                        <!--Khách -->
                        @guest
                            @if (!auth()->check() || (auth()->check() && auth()->user()->role != 'admin'))
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="{{ route('cart.index') }}">
                                        <i class="fas fa-shopping-cart me-2"></i> Giỏ Hàng
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="{{ route('orders.index') }}">
                                        Đơn Hàng Của Bạn
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Đăng Nhập</a>
                            </li>
                        @endguest

                        <!--Đã đăng nhập -->
                        @auth
                            <li class="nav-item d-flex align-items-center">
                                @if (auth()->check())
                                    <span class="navbar-text me-3">
                                        Hello, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    </span>
                                @endif
                            </li>
                            @if (auth()->user()->role != 'admin')
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="{{ route('cart.index') }}">
                                        <i class="fas fa-shopping-cart me-2"></i> Giỏ Hàng
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="{{ route('orders.index') }}">
                                        Đơn Hàng Của Bạn
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link">Đăng Xuất</button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <div class="container" style="margin-top: 1000px">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h5>Đăng ký nhận thông tin mới nhất</h5>
                <p>Nhập địa chỉ email của bạn để nhận thông tin và cập nhật từ chúng tôi.</p>
                <form action="" method="POST" class="d-flex justify-content-center">
                    @csrf
                    <input type="email" name="email" class="form-control me-2" placeholder="Nhập địa chỉ email"
                        required>
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Thông tin</h5>
                    <p>
                        Đây là một trang web mẫu được xây dựng bằng Laravel. Bạn có thể tìm thấy nhiều thông tin và sản
                        phẩm hữu ích tại đây.
                    </p>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Liên kết</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('categories.index') }}" class="text-dark">Danh sách Danh mục</a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}" class="text-dark">Danh sách Sản phẩm</a>
                        </li>
                        <li>
                            <a href="" class="text-dark">Liên hệ</a>
                        </li>
                        <li>
                            <a href="" class="text-dark">Giới thiệu</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Theo dõi chúng tôi</h5>
                    <a href="#" class="me-4 text-dark">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="me-4 text-dark">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="me-4 text-dark">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.1);">
            © 2024 Copyright:
            <a class="text-dark" href="{{ route('home') }}">Hello.com</a>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
