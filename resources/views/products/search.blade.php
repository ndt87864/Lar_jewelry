<!-- resources/views/products/search.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Kết quả tìm kiếm cho: "{{ request('query') }}"</h1>

    @if($products->isEmpty())
        <p>Không tìm thấy sản phẩm nào.</p>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <!-- Hiển thị hình ảnh sản phẩm -->
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}"
                                class="card-img-top" alt="{{ $product->name }}"
                                style="width: 100%; height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <!-- Tên sản phẩm -->
                            <a
                                href="{{ route('products.showSearch', ['product' => $product->id, 'query' => request('query')]) }}">
                                <h5 class="card-title text-dark">{{ $product->name }}</h5>
                            </a>

                            <!-- Danh mục sản phẩm -->
                            <p class="card-text">{{ $product->category->name ?? 'Chưa có danh mục' }}</p>
                            <!-- Giá sản phẩm -->
                            <p class="card-text"><strong>{{ number_format($product->price, 2) }} VND</strong></p>
                            <!-- Kiểm tra đăng nhập khi thêm vào giỏ hàng -->
                            @if (Auth::check())
                                <form action="{{ route('user.cart.add', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Thêm vào giỏ hàng</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-warning btn-lg btn-block"
                                    onclick="alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!')">
                                    Thêm vào giỏ hàng
                                </a></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection