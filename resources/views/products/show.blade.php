@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                @if($product->image_url)
                <img src=" {{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                    style="max-width: 100%; height: 600px; object-fit: cover;" @else No Image @endif" alt=""
                    class="card-img-top mb-5 mb-md-0">
            </div>
            <div class="col-md-6">
                <div class="small mb-1"></div>
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                <div class="fs-5 ">
                    <span>{{ $product->price }}</span>
                </div>
                <div class="fs-5 mb-5">Stock:    {{ $product->stock }}</div>
                <p class="lead">{{ $product->description }}</p>
                <div class="d-flex">
                    <input type="text" id="stock" class=" text-center me-3">
                    <button class=" btn btn-outline-dark flex-shrink-0">
                        <i class="bi-cart-fill me-1"></i>
                        Add To Card
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
