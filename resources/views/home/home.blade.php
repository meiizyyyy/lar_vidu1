@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">NEW ARRIVALS</h1>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image_url) }}" class="product-card-img"
                            alt="{{ $product->name }}">
                        <div class="product-card-body">
                            <h5 class="product-card-title">{{ $product->name }}</h5>
                            <p class="product-card-stock">Còn lại: {{ $product->stock }}</p>
                            <p class="product-card-description">{{ $product->category->name }}</p>
                            <p class="product-card-price">
                                {{ number_format($product->price, 0) }}đ
                            </p>
                            <div class="btn-group" role="group">
                                <a href="{{ route('products.show', $product->product_id) }}" class="btn btn-link">Xem chi
                                    tiết</a>
                                <button type="button" class="btn btn-link add-to-cart"
                                    data-product-id="{{ $product->product_id }}">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="notification" style="display: none;" class="notification"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function() {
                var productId = $(this).data('product-id');
                var token = '{{ csrf_token() }}';
                var isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

                if (!isAuthenticated) {
                    window.location.href = '/login'; // Chuyển hướng đến trang đăng nhập
                    return;
                }

                $.ajax({
                    url: '/cart/add/' + productId,
                    type: 'POST',
                    data: {
                        _token: token,
                    },
                    success: function(response) {
                        showNotification('Đã thêm ' + response.product_name +
                            ' vào giỏ hàng thành công!');
                    },
                    error: function() {
                        showNotification('Có lỗi xảy ra. Vui lòng thử lại!');
                    }
                });
            });
        });

        function showNotification(message) {
            var notification = $('#notification');
            notification.text(message).fadeIn().css({
                top: '60px',
                right: '20px',
                position: 'fixed',
                background: '#28a745', // Màu xanh lá
                color: '#fff',
                padding: '10px',
                borderRadius: '5px',
                zIndex: 1050,
            });
            setTimeout(function() {
                notification.fadeOut();
            }, 5000);
        }
    </script>

    <style>
        .notification {
            display: none;
        }
    </style>
@endsection
