@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Chi tiết đơn hàng: <span class="text-primary">#{{ $order->id }}</span></h1>

    <!-- Thông tin người dùng -->
    <p><strong>Người dùng:</strong> {{ $order->user->name }}</p>

    <!-- Thông tin đơn hàng -->
    <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 2) }} VND</p>
    <p><strong>Trạng thái:</strong>
        <span class="badge 
            @if($order->status == 'processing') badge-warning
            @elseif($order->status == 'paid') badge-success
                @else badge-secondary
            @endif">
            @if($order->status == 'processing')
                Đang xử lý
            @elseif($order->status == 'paid')
                Đã thanh toán
            @elseif($order->status == 'cancelled')
                Đã hủy
            @else
                Không xác định
            @endif
        </span>

    </p>
    <p><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method) }}</p>

    <h2 class="mt-4">Sản phẩm trong đơn hàng</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá (VND)</th>
                <th>Thành tiền (VND)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary mt-3">Quay lại danh sách đơn hàng</a>
</div>
@endsection