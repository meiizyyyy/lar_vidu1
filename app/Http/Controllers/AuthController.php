<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    //
    public function showRegisterForm()
    {
        return view('auth.register');  // Trả về form đăng ký
    }

    public function register(Request $request)
    {
        // Validate dữ liệu nhập vào
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo người dùng mới
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            // 'role' => 'customer',  // Mặc định là customer
        ]);

        // Đăng nhập sau khi đăng ký
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('home');  // Điều hướng về trang chủ sau khi đăng ký
    }

    public function showLoginForm()
    {
        return view('auth.login');  // Trả về form đăng nhập
    }

    public function login(Request $request)
    {
        // Validate thông tin đăng nhập
        $credentials = $request->validate([
            'login' => 'required',  // login có thể là username hoặc email
            'password' => 'required',
        ]);

        // Kiểm tra nếu login là email hay username
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Thử đăng nhập với username hoặc email
        if (auth()->attempt([$login_type => $request->login, 'password' => $request->password])) {
            // Đăng nhập thành công
            return redirect()->intended('/home');
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');  // Điều hướng về trang đăng nhập sau khi đăng xuất
    }
}
