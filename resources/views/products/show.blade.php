@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-start">
                <div class="col-lg-6">
                    @if ($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                            class="img-fluid rounded mb-4" style="max-height: 400px; object-fit: cover;">
                    @else
                        <p class="text-center">Không có hình ảnh</p>
                    @endif
                </div>
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bolder mb-3">{{ $product->name }}</h2>
                    <div class="fs-5 mb-3">
                        <span class="text-success">{{ number_format($product->price, 2) }} VNĐ</span>
                    </div>
                    <div class="fs-6 mb-4">Số lượng: <strong>{{ $product->stock }}</strong></div>

                    <div class="product-details mb-4">
                        <h5>Thông tin sản phẩm:</h5>
                        <ul class="list-unstyled">
                            <li><strong>Thương hiệu:</strong> {{ $product->brand }}</li>
                            <li><strong>Danh mục:</strong> {{ $product->category->name }}</li>
                            <li><strong>Màu sắc:</strong> {{ $product->color }}</li>
                            <li><strong>Kích thước:</strong> {{ $product->size }}</li>
                        </ul>
                    </div>

                    <div class="description-container mb-4" style="max-height: 150px; overflow-y: auto;">
                        <p class="lead">{{ $product->description }}</p>
                    </div>

                    <form id="add-to-cart-form" data-product-id="{{ $product->product_id }}" class="mt-4">
                        @csrf
                        <button type="button" class="btn btn-primary add-to-cart">
                            <i class="fas fa-shopping-cart"></i> Thêm vào Giỏ Hàng
                        </button>
                    </form>
                    <div id="message" style="display: none;"></div>

                </div>
            </div>
        </div>
    </section>

    <style>
        .description-container {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .product-details {
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        h2,
        h5 {
            color: #333;
        }

        .text-success {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function() {
                var productId = $('#add-to-cart-form').data('product-id');
                var token = $('input[name="_token"]').val();

                // Kiểm tra xem người dùng đã đăng nhập
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
                        $('#message').text('Đã thêm ' + response.product_name +
                            ' vào giỏ hàng thành công!').show();
                    },
                    error: function() {
                        $('#message').text('Có lỗi xảy ra. Vui lòng thử lại!').show();
                    }
                });
            });
        });
    </script>
@endsection
