@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card mx-auto shadow-sm" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Chỉnh sửa tài khoản</h2>

            <form action="{{ route('showUser.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                <!-- Thêm enctype -->
                @csrf
                @method('PUT')

                <!-- Tên người dùng -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
                        required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email người dùng -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mật khẩu -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu (để trống nếu không muốn thay đổi)</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Hình ảnh người dùng -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh (tùy chọn)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    
                </div>
                <div>
                    
                @if($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Hình ảnh người dùng" style="width: 100%;height: 10%;">

                        @else
                            <img src="{{ asset('storage/products/no.jpg') }}" alt="No Image" class="card-img-top">
                        @endif
                </div>
                <!-- Nút bấm -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('showUser.show', $user->id) }}" class="btn btn-danger">Quay lại danh sách</a>
                    <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection