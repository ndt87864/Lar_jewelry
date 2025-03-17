<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Orders;
use App\Models\Payment;
use App\Models\OrderItems;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy thông tin giỏ hàng của người dùng với chi tiết sản phẩm
        $cart = Cart::where('user_id', Auth::id())->get();

        // Tính tổng số lượng sản phẩm trong giỏ hàng
        $cartCount = $cart->sum('quantity');
        $orders = Orders::where('user_id', Auth::id())->get();
        return view('user.orders.index', compact('orders', 'cartCount'));
    }

    public function store(Request $request)
    {
        // Lấy giỏ hàng từ cơ sở dữ liệu
        $cart = Cart::where('user_id', Auth::id())->get();

        // Kiểm tra nếu giỏ hàng trống
        if ($cart->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn trống.');
        }

        // Tạo đơn hàng mới
        $order = Orders::create([
            'user_id' => Auth::id(),
            'total' => $request->total,
            'status' => 'processing',
            'payment_method' => $request->payment_method,
        ]);

        // Lưu các mặt hàng trong đơn hàng
        foreach ($cart as $item) {
            OrderItems::create([
                'orders_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'image' => $item->image,
            ]);
        }
        
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $order->payment_method,
            ]);
        // Xóa giỏ hàng sau khi đặt hàng
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('user.orders.index')->with('success', 'Đặt hàng thành công!');
    }

    public function show($id)
    {
        $cart = Cart::where('user_id', Auth::id())->get();

        // Tính tổng số lượng sản phẩm trong giỏ hàng
        $cartCount = $cart->sum('quantity');
        // Lấy đơn hàng theo ID và xác minh nó thuộc về người dùng hiện tại
        $order = Orders::where('id', $id)->where('user_id', Auth::id())->with('items.product')->firstOrFail();

        // Trả về view hiển thị chi tiết đơn hàng
        return view('user.orders.show', compact('order', 'cartCount'));
    }
}
