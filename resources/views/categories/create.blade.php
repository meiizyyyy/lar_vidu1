@extends('layouts.app')

@section('content')
<h1>Add New Category</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="main-content mt-3">
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Category Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="description" class="form-control "
                    placeholder="Enter description for this category" required>
            </div>
        </div>
    </div>
    <div class="form__btn-nav mt-4">
        <button type="submit" class="btn btn-primary ">Add Category</button>
        <a href="{{ url()->previous() }}" class="btn btn-danger">Go Back</a>
    </div>
</form>
@endsection