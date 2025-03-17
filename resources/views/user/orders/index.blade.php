@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Đơn hàng của bạn</h1>

    @if(count($orders) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                                    <tr>
                                        <td><a href="{{ route('user.orders.show', $order->id) }}" class="text-primary">#{{ $order->id }}</a></td>
                                        <td>{{ number_format($order->total, 2) }} VND</td>
                                        <td>
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

                                        </td>
                                        <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Bạn chưa có đơn hàng nào.
        </div>
    @endif
</div>
@endsection