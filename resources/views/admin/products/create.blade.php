@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card mx-auto shadow-sm" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Thêm sản phẩm</h2>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"> <!-- Thêm enctype -->
                @csrf

                <!-- Tên sản phẩm -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autocomplete="off">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mô tả sản phẩm -->
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Số lượng sản phẩm -->
                <div class="mb-3">
                    <label for="quantity" class="form-label">Số lượng</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" required>
                    @error('quantity')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Giá sản phẩm -->
                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Danh mục sản phẩm -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Hình ảnh sản phẩm -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nút bấm -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Quay lại danh sách</a>
                    <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
