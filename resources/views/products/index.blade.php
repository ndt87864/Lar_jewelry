@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Danh sách trang sức</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($products->isEmpty())
        <p>Không có sản phẩm nào được tìm thấy.</p>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <!-- Kiểm tra đăng nhập khi xem chi tiết sản phẩm -->
                        @if (Auth::check())
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                                    class="card-img-top" alt="{{ $product->name }}"
                                    style="width: 100%; height: 200px; object-fit: cover;">
                            </a>
                        @else
                            <a href="{{ route('login') }}" onclick="alert('Bạn cần đăng nhập để xem chi tiết sản phẩm!')">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                                    class="card-img-top" alt="{{ $product->name }}"
                                    style="width: 100%; height: 200px; object-fit: cover;">
                            </a>
                        @endif

                        <div class="card-body">
                            <!-- Tên sản phẩm -->
                            <a href="{{ route('products.show', $product->id) }}">
                                <h5 class="card-title text-dark">{{ $product->name }}</h5>
                            </a>

                            <!-- Danh mục sản phẩm -->
                            <p class="card-text">{{ $product->category->name ?? 'Chưa có danh mục' }}</p>

                            <!-- Giá sản phẩm -->
                            <p class="card-text"><strong>{{ number_format($product->price, 2) }} VND</strong></p>

                            <!-- Form thêm vào giỏ hàng -->
                            @if (Auth::check())
                                <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-block">Thêm vào giỏ hàng</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-warning btn-block"
                                    onclick="alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!')">
                                    Thêm vào giỏ hàng
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection