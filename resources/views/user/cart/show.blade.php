@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">{{ $product->name }}</h1>

    <div class="mb-3">
        <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
        <p><strong>Giá:</strong> {{ number_format($product->price, 2) }} VND</p>
        <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
    </div>

    <div class="mb-3">
        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Thêm giỏ hàng</button>
        </form>
    </div>
</div>
@endsection