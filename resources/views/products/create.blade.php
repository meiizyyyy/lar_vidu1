@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Create New Product</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Product Name:</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Product Description:</label>
                <div class="col-sm-10">
                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-10">
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                        step="0.01" required>
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="stock" class="col-sm-2 col-form-label">Stock:</label>
                <div class="col-sm-10">
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}"
                        required>
                    @error('stock')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="category_id" class="col-sm-2 col-form-label">Category:</label>
                <div class="col-sm-10">
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}"
                                {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Product Image:</label>
                <div class="col-sm-10">
                    <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form__btn-nav mt-4">
                <button type="submit" class="btn btn-primary">Create Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Product List</a>
            </div>
        </form>
    </div>
@endsection
