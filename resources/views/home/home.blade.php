@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>All Products</h1>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 d-flex flex-column">
                @if ($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}"
                    style="height: 200px; object-fit: cover;">
                @else
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image"
                    style="height: 50px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                    <a href="{{ route('products.show', $product->product_id) }}" class="btn btn-primary mt-auto">View
                        Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
