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
                                <a href="{{ route('products.show', $product->product_id) }}" class="btn btn-link">Xem chi tiết</a>
                                <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
