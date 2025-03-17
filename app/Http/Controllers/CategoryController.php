<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // Lấy thông tin giỏ hàng của người dùng với chi tiết sản phẩm
        $cart = Cart::where('user_id', Auth::id())->get();
    
        // Tính tổng số lượng sản phẩm trong giỏ hàng
        $cartCount = $cart->sum('quantity');
        $categories = Category::all();
        return view('categories.index', compact('categories', 'cartCount'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Sửa  danh mục thành công.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công.');
    }
}
