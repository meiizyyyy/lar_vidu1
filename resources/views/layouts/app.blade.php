<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> <!-- Liên kết đến file CSS tùy chỉnh -->

</head>

<body>
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Laravel PHP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
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
                                    <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Admin
                                            Category List</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Admin
                                            Product List</a></li>
                                </ul>
                            </li>
                        @endif
                        @guest
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item d-flex align-items-center">
                                @if (auth()->check())
                                    <span class="navbar-text me-3">
                                        Hello, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    </span>
                                @endif
                            </li>
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
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>

            </div>
        </nav>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
