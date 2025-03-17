<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Lấy thông tin giỏ hàng của người dùng với chi tiết sản phẩm
        $cart = Cart::where('user_id', Auth::id())->get();
    
        // Tính tổng số lượng sản phẩm trong giỏ hàng
        $cartCount = $cart->sum('quantity');
    
        return view('user.cart.index', compact('cart', 'cartCount'));
    }
    
    public function add(Request $request, Product $product)
    {
        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();

        if ($cart) {
            // Nếu đã có, tăng số lượng
            $cart->increment('quantity');
        } else {
            // Nếu chưa có, tạo mới với chi tiết sản phẩm
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'category' => $product->category->name,
                'image' => $product->image,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('user.cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function remove(Product $product)
    {
        // Xóa sản phẩm khỏi giỏ hàng của người dùng
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();

        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('user.cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    public function update(Request $request, $id)
    {
        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $cart = Cart::where('user_id', Auth::id())->where('id', $id)->first();

        if ($cart && $request->has('quantity') && $request->quantity > 0) {
            $cart->update(['quantity' => $request->quantity]);
            return redirect()->route('user.cart.index')->with('success', 'Giỏ hàng đã được cập nhật');
        }
    }
}
