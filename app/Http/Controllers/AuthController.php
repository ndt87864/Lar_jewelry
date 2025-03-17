<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký người dùng
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation cho hình ảnh
        ]);
    
        // Khởi tạo dữ liệu để lưu
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer',
        ];
    
        // Kiểm tra nếu có hình ảnh được tải lên
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $data['image'] = $imagePath; // Lưu đường dẫn hình ảnh
        }
    
        // Tạo người dùng mới
        User::create($data);
    
        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }
    
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập người dùng
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Lấy người dùng hiện tại
            $user = Auth::user();

            // Kiểm tra vai trò của người dùng và chuyển hướng phù hợp
            if ($user->role === 'admin') {
                return redirect()->intended('admin/categories');
            }

            return redirect()->intended('products');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    // Xử lý đăng xuất người dùng
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
