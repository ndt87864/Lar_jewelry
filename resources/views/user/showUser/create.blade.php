@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card mx-auto shadow-sm" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Thêm tài khoản</h2>

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"> <!-- Thêm enctype -->
                @csrf

                <!-- Tên người dùng -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autocomplete="off">
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email người dùng -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mật khẩu -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Xác nhận mật khẩu -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    @error('password_confirmation')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Hình ảnh người dùng -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh (tùy chọn)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Quyền Admin -->
                <div class="form-check mb-3">
                    <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input">
                    <label for="is_admin" class="form-check-label">Quyền Admin</label>
                </div>

                <!-- Nút bấm -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Quay lại danh sách</a>
                    <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
