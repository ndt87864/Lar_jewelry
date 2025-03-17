@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Giỏ hàng của bạn</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($cart->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                @php
                    $total = 0;
                @endphp
                @foreach ($cart as $item)
                        @php
                            $total += $item->price * $item->quantity;
                        @endphp
                        <div class="card mb-3 p-3 shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-2 d-flex align-items-center">
                                    <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('storage/products/no.jpg') }}"
                                        alt="{{ $item->name }}" class="img-fluid img-thumbnail">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <p class="card-text">{{ number_format($item->price, 2) }} VND</p>
                                        <p class="card-text"><small class="text-muted">Danh mục: {{ $item->category }}</small></p>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
                                    <form action="{{ route('user.cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                            class="form-control quantity-input" style="width: 80px;" onchange="this.form.submit()">
                                    </form>
                                    <p class="mt-2">Thành tiền: <strong>{{ number_format($item->price * $item->quantity, 2) }}
                                            VND</strong></p>
                                    <form action="{{ route('user.cart.remove', $item->product_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm mt-2">Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>

            <div class="col-lg-4">
                <div class="card p-3 shadow-sm">
                    <h4 class="mb-4">Tóm tắt đơn hàng</h4>
                    <p>Tổng: <strong>{{ number_format($total, 2) }} VND</strong></p>
                    <form action="{{ route('user.orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total" value="{{ $total }}">
                        <div class="form-group">
                            <label for="payment_method">Phương thức thanh toán: </label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="COD">Thanh toán khi nhận hàng (COD)</option>
                                <option value="online">Thanh toán trực tuyến</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Đặt hàng</button>
                    </form>

                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-block mt-3">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Giỏ hàng của bạn trống.
        </div>
    @endif
</div>
@endsection