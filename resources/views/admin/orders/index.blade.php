@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Danh sách đơn hàng</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Sản phẩm</th> <!-- Thêm cột cho sản phẩm -->
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Phương thức thanh toán</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td><a href="{{ route('admin.orders.showOrder', $order->id) }}" class="text-primary">#{{ $order->id }}</a></td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        @foreach ($order->items as $item) <!-- Lặp qua các sản phẩm trong đơn hàng -->
                            {{ $item->product->name }} (x{{ $item->quantity }})<br>
                        @endforeach
                    </td>
                    <td>{{ $order->total }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="form-control mb-3">
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý
                                </option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $order->payment_method }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection