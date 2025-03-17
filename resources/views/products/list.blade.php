@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Danh sách sản phẩm @if(isset($category)) trong danh mục {{ $category->name }} @endif</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top"
                            style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/products/no.jpg') }}" alt="No Image" class="card-img-top"
                            style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        @if ($product->category)
                                        <!-- Kiểm tra đăng nhập khi hiển thị danh mục sản phẩm -->
                                        <a href="{{ route('products.showFromList',['category' => $product->category->id, 'id' => $product->id]) }}">
                                            <h5 class="card-title text-dark">{{ $product->name }}</h5>
                                        </a>
                        @endif

                        <p class="card-text"><strong>Giá:</strong> {{ number_format($product->price, 2) }} VND</p>

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
</div>
@endsection