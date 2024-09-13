@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Product: {{ $product->name }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Product Name:</label>
            <div class="col-sm-10">
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                    required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="description" class="col-sm-2 col-form-label">Description:</label>
            <div class="col-sm-10">
                <textarea id="description" name="description" class="form-control"
                    rows="4">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>

        <div class="mb-3 row ">
            <label for="price" class="col-sm-2 col-form-label">Price:</label>
            <div class="col-sm-10">
                <input type="number" id="price" name="price" class="form-control"
                    value="{{ old('price', $product->price) }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="stock" class="col-sm-2 col-form-label">Stock:</label>
            <div class="col-sm-10">
                <input type="number" id="stock" name="stock" class="form-control"
                    value="{{ old('stock', $product->stock) }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="category_id" class="col-sm-2 col-form-label">Category:</label>
            <div class="col-sm-10">
                <select id="category_id" name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}" {{ $category->category_id == $product->category_id ?
                        'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="image" class="col-sm-2 col-form-label">Product Image:</label>
            <div class="col-sm-10">
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                @if ($product->image_url)
                <div class="mt-2">
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" width="100">
                </div>
                @endif
            </div>
        </div>

        <div class="form__btn-nav mt-4">
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Product List</a>
        </div>
    </form>
</div>
@endsection