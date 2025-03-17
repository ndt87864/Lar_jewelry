@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card mx-auto shadow-sm" style="max-width: 500px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Thêm danh mục</h2>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tên danh mục -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" required>
                </div>

                <!-- Hình ảnh -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <div class="form-text">Tải lên hình ảnh (tùy chọn)</div>
                </div>

                <!-- Nút bấm -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Tạo danh mục</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
