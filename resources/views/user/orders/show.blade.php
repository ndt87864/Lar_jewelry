@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Chi tiết đơn hàng: <span class="text-primary">#{{ $order->id }}</span></h2>
    <div class="row">
        <!-- Chi tiết đơn hàng -->
        <div class="col-lg-8">

            <!-- Thông tin đơn hàng -->
            <div class="card mb-3 p-3 shadow-sm">
                <div class="row g-0">
                    <!-- Ngày đặt hàng & Trạng thái -->
                    <div class="col-md-6">
                        <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('H:i d/m/Y')}}</p>
                    </div>
                    <div class="col-md-6 text-right">
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
                    </div>
                </div>
            </div>

            <!-- Sản phẩm trong đơn hàng -->
            @foreach ($order->items as $item)
                <div class="card mb-3 p-3 shadow-sm">
                    <div class="row g-0">
                        <!-- Hình ảnh sản phẩm -->
                        <div class="col-md-2 d-flex align-items-center">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product->name }}"
                                    class="img-fluid img-thumbnail">
                            @else
                                <img src="{{ asset('storage/products/no.jpg') }}" alt="No image"
                                    class="img-fluid img-thumbnail">
                            @endif
                        </div>
                        <!-- Thông tin sản phẩm -->
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->product->name }}</h5>
                                <p class="card-text">{{ number_format($item->price, 2) }} VND</p>
                                <p class="card-text"><small class="text-muted">Số lượng: {{ $item->quantity }}</small></p>
                            </div>
                        </div>
                        <!-- Thành tiền -->
                        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
                            <p>Thành tiền:
                                <strong>{{ number_format($item->price * $item->quantity, 2) }} VND</strong>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Thông tin thanh toán -->
        <div class="col-lg-4">
            <div class="card p-3 shadow-sm">
                <h4 class="mb-4">Thanh toán</h4>
                <p>Tổng tiền: <strong class="text-danger">{{ number_format($order->total, 2) }} VND</strong></p>
                <br />
                <p><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method) }}</p>
                <br />
                <a href="{{ route('user.orders.index') }}" class="btn btn-outline-primary btn-block mt-3">Quay lại đơn
                    hàng</a>
            </div>
        </div>
    </div>
</div>
@endsection