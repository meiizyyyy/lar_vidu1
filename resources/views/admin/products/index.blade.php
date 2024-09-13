@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Product List</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add New Products</a>

        <div class="table-responsive"> <!-- Đảm bảo bảng có thể cuộn ngang khi cần -->
            <table class="table table-bordered ">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th style="width: 400px;">Description</th> <!-- Giới hạn độ rộng cột mô tả -->
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
                            <td style="max-width: 400px; white-space: normal; overflow-y: auto; max-height: 150px; display: block;">
                                {{ $product->description }}
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td style="max-width: 150px; white-space: normal; overflow-y: auto; max-height: 100px; display: block;">
                                {{ $product->category ? $product->category->name : 'No category' }}
                            </td>
                            <td>
                                @if ($product->image_url)
                                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST"
                                    style="display:inline-block" onsubmit="return confirm('Remove this Product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <br>
                                <a href="{{ route('products.show', $product->product_id) }}" class="btn btn-secondary btn-sm mt-3">
                                    View Product Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
