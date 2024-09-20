@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">NEW ARRIVALS</h1>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card border-light h-100" style="border-radius: 0;">
                        <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top"
                            alt="{{ $product->name }}" style="height: 400px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $product->name }}</h5>
                            <p class="font-weight-bold" style="font-size: 1.5rem;">{{ number_format($product->price, 0) }}đ
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Còn lại: {{ $product->stock }}</span>
                                <a href="{{ route('products.show', $product->product_id) }}"
                                    class="btn btn-outline-secondary">Xem chi tiết</a>
                                <form action="{{ route('cart.add', $product->product_id) }}" method="POST" class="ml-2">
                                    @csrf
                                    <button type="submit" class="">
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
