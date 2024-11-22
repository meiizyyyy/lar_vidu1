@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card border-0">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Đăng Nhập</h4>

                        <!-- Hiển thị thông báo từ session -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Hiển thị lỗi từ validator -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="username">Email</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group mb-4">
                                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                            </div>

                            <div class="text-left">
                                <a href="{{ route('register') }}" class="text-decoration-none">Đăng Ký</a>
                            </div>
                            <div class="text-left mt-3">
                                {{-- <a href="{{ route('password.request') }}" class="text-decoration-none">Quên mật khẩu?</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
