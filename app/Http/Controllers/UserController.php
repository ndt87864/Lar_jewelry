<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        $cartCount = $cart->sum('quantity');
        $user = User::findOrFail($id);
        return view('user.showUser.show', compact('user', 'cartCount')); // Đảm bảo đường dẫn đúng đến view
    }


    // Hiển thị trang chỉnh sửa thông tin người dùng
    public function edit($id)
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        $cartCount = $cart->sum('quantity');
        $user = User::findOrFail($id);
        return view('user.showUser.edit', compact('user', 'cartCount'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // Password có thể bỏ trống
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Cập nhật hình ảnh
        if ($request->hasFile('image')) {
            // Xóa hình cũ nếu có
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Lưu hình ảnh mới
            $imagePath = $request->file('image')->store('users', 'public');
            $user->image = $imagePath; // Cập nhật đường dẫn hình ảnh
        }

        // Chỉ cập nhật password nếu có giá trị mới
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->has('is_admin') ? 'admin' : 'customer';
        $user->save();

        return redirect()->route('products.index')->with('success', 'Cập nhật tài khoản thành công!');
    }

}
