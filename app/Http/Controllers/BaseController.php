<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $cartCount = 0;

    public function __construct()
    {
        // Tính số lượng đơn hàng trong giỏ
        if (Auth::check()) {
            $this->cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        }
    }
}
