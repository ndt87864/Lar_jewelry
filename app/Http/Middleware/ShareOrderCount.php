<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Orders;
use Illuminate\Support\Facades\View;

class ShareOrderCount
{
    public function handle($request, Closure $next)
    {
        // Đếm số lượng đơn hàng
        $orderCount = Orders::count();

        // Chia sẻ biến $orderCount với tất cả các view
        View::share('orderCount', $orderCount);

        return $next($request);
    }
}
