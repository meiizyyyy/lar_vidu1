@extends('layouts.app')

@section('content')
<h1>Product List</h1>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Products</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->category ? $product->category->name : 'No category' }}</td>
            <td>
                @if($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" width="100">
                @else
                No Image
                @endif
            </td>
            <td>
                <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('products.destroy', $product->product_id) }}" method="POST"
                    style="display:inline-block" onsubmit="return confirm('Remove this Product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                <br>
                <a href="{{ route('products.show', $product->product_id) }}" class="btn btn-secondary btn-sm mt-3">View Product Details</a>

            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection
