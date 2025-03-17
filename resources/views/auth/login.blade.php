@extends('layouts.login')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4 text-dark font-weight-bold">Đăng Nhập</h2>

        <!-- Kiểm tra nếu có lỗi sẽ hiển thị -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form đăng nhập -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Địa chỉ email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">Đăng Nhập</button>
        </form>

        <hr class="my-4">

        <div class="text-center">
            <a href="{{ route('register') }}" class="btn btn-secondary btn-lg w-100">Tạo Tài Khoản Mới</a>
        </div>
        
        <div class="footer">
            <p>Bằng cách đăng nhập, bạn đồng ý với <a href="#" class="text-primary">Điều khoản dịch vụ</a> và <a href="#" class="text-primary">Chính sách quyền riêng tư</a>.</p>
        </div>
    </div>
</div>
@endsection
<!-- #region -->