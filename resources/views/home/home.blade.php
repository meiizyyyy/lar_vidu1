@extends('layouts.app')


@section('content')
    @include('home.new-arrivals', ['newArrivals' => $newArrivals])
    
    <div class="container-fluid d-flex justify-content-center">
        <div class="row mt-5">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-3 mb-4">
                    <a href="{{ route('products.show', $product->product_id) }}" class="product-card h-100 d-block">
                        <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <h5 class="mb-0">{{ $product->name }}</h5>
                            </div>
                            <hr class="mt-2">
                            <div class="d-flex justify-content-between pb-2">
                                <div class="d-flex flex-column">
                                    <span class="text-muted">Còn lại</span>
                                    <h5 class="mb-0">{{ $product->stock }}</h5>
                                </div>
                                <div class="d-flex flex-column text-right">
                                    <small class="text-muted">Danh mục</small>
                                    <h6 class="mb-0">{{ $product->category->name }}</h6>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-3 mid flex-grow-1">
                                <div class="d-flex flex-column">
                                    <h3 class="mb-0 text-danger">{{ number_format($product->price, 0) }}đ</h3>
                                </div>
                                <div class="d-flex flex-column text-right">
                                    <small class="text-muted mb-1">Đánh giá</small>
                                    <h6 class="mb-0">{{ $product->rating ?? 'N/A' }}</h6>
                                </div>
                            </div>
                            <div class="card__btn mx-3 mt-4 mb-2">
                                <button type="button" class="btn btn-danger btn-block add-to-cart"
                                    data-product-id="{{ $product->product_id }}">
                                    <small>THÊM VÀO GIỎ</small>
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div id="notification" style="display: none;" class="notification"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function(event) {
                event.stopPropagation(); // Ngăn chặn sự kiện click tràn vào thẻ <a>
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
            }, 4000);
        }
    </script>

    <style>

    </style>
@endsection
