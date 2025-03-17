@extends('layouts.app') 

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-5">
            <div class="product-image text-center">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="img-fluid img-thumbnail">
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="Chưa có hình ảnh" class="img-fluid img-thumbnail">
                @endif
            </div>
        </div>

        <!-- Thông tin chi tiết sản phẩm -->
        <div class="col-md-7">
            <h1 class="product-name">{{ $product->name }}</h1>
            <p class="product-category"><strong>Danh mục:</strong> {{ $product->category->name }}</p>
            <p class="product-price">
                <strong>Giá:</strong>
                <span class="text-danger" style="font-size: 1.5rem;">{{ number_format($product->price, 2) }} VND</span>
            </p>

            <div class="product-details mt-4">
                <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                <p><strong>Số lượng có sẵn:</strong> {{ $product->quantity }}</p>
            </div>

            <!-- Nút thêm vào giỏ hàng -->
            <div class="mt-4">
                @if (Auth::check())
                    <!-- Nếu người dùng đã đăng nhập, cho phép thêm vào giỏ hàng -->
                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-lg btn-block">Thêm vào giỏ hàng</button>
                    </form>
                @else
                    <!-- Nếu chưa đăng nhập, hiển thị thông báo yêu cầu đăng nhập -->
                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg btn-block"
                        onclick="alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!')">
                        Thêm vào giỏ hàng
                    </a>
                @endif
            </div>

            <!-- Nút quay lại -->
            <div class="mt-3">
                @if(request('query'))
                    <a href="{{ route('products.search', ['query' => request('query')]) }}"
                        class="btn btn-secondary btn-block">Quay lại kết quả tìm kiếm</a>
                @else
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-block">Quay lại danh sách</a>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection