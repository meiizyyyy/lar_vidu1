@extends('layouts.app')

@section('content')
    <h1>Categories</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->category_id }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->category_id) }}">
                            {{ $category->name }}
                        </a>
                    </td>
                    <td>{{ $category->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
