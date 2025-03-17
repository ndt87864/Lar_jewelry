@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card mx-auto shadow-sm" style="max-width: 500px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Sửa danh mục</h2>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tên danh mục -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required autocomplete="off">
                </div>

                <!-- Hình ảnh -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail mt-2" width="100">
                    @else
                        <img src="{{ asset('storage/products/no.jpg') }}" alt="Không có hình" class="img-thumbnail mt-2" width="100">
                    @endif
                </div>

                <!-- Nút bấm -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
