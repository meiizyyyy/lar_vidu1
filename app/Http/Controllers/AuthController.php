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
        return view('auth.register'); 
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

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate thông tin đăng nhập
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Kiểm tra nếu username là email hay username
        $login_type = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (auth()->attempt([$login_type => $request->username, 'password' => $request->password])) {
            // Đăng nhập thành công
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/');
        }


        // Đăng nhập thất bại
        return back()->withErrors([
            'username' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('username');
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
