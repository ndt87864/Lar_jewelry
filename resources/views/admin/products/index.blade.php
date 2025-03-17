@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Danh sách trang sức</h1>

    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm sản phẩm mới</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th> Hình ảnh</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100"
                                class="mt-2">
                        @else
                            <span>Chưa có hình ảnh</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price, 2) }} VND</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection