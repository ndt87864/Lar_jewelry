<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Import Str

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $cart = Cart::where('user_id', Auth::id())->get();
        $cartCount = $cart->sum('quantity');

        // Cắt ngắn tên sản phẩm về tối đa 50 ký tự
        foreach ($products as $product) {
            $product->name = Str::limit($product->name, 15, '...');
        }

        return view('products.index', compact('products', 'cartCount'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories')); // Sửa biến thành 'categories'
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Thêm tủ lạnh thành công.');
    }

    public function show(Product $product)
    {

        $cart = Cart::where('user_id', Auth::id())->get();
        $cartCount = $cart->sum('quantity');
        return view('products.show', compact('product', 'cartCount'));
    }

    public function showFromList($categoryId, $productId)
    {

        $cart = Cart::where('user_id', Auth::id())->get();
        $cartCount = $cart->sum('quantity');
        $product = Product::with('category')->findOrFail($productId);
        return view('products.showFromList', compact('product', 'cartCount'));
    }

    public function list($categoryName)
    {
        $category = Category::where('name', $categoryName)->first();

        $cart = Cart::where('user_id', Auth::id())->get();
        $cartCount = $cart->sum('quantity');
        if (!$category) {
            return redirect()->route('products.list')->with('error', 'Danh mục không tồn tại.');
        }

        $products = Product::where('category_id', $category->id)->get();
        foreach ($products as $product) {
            $product->name = Str::limit($product->name, 15, '...');
        }
        return view('products.list', compact('products', 'category', 'cartCount'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Sửa sản phẩm thành công');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Gỡ sản phẩm thành công');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Lưu query vào session
        session(['query' => $query]);

        $cart = Cart::where('user_id', Auth::id())->get();
        $cartCount = $cart->sum('quantity');

        // Tìm kiếm sản phẩm theo tên
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        // Cắt ngắn tên sản phẩm về tối đa 50 ký tự
        foreach ($products as $product) {
            $product->name = Str::limit($product->name, 15, '...');
        }

        return view('products.search', compact('products', 'cartCount'));
    }

    public function showSearch(Product $product)
    {
        $cart = Cart::where('user_id', Auth::id())->get();
        $cartCount = $cart->sum('quantity');

        // Lấy query từ session
        $query = session('query'); // Đảm bảo session đã được khởi tạo

        return view('products.showSearch', compact('product', 'cartCount', 'query'));
    }


}

