@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-5">
            <div class="product-image" style="margin-top:5%">
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

            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
            </form>

            <!-- Nút quay lại -->
            <div class="mt-3">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-block">Quay lại danh sách</a>
            </div>
        </div>
    </div>
</div>
@endsection