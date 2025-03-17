@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-5">
            <div class="user-image">
                @if ($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="img-fluid"
                        style="width: 100%; height: auto;">
                @else
                    <img src="{{ asset('storage/products/no.jpg') }}" alt="Chưa có hình ảnh" class="img-fluid"
                        style="width: 100%; height: auto;">
                @endif
            </div>
        </div>
        <!-- Thông tin chi tiết người dùng -->
        <div class="col-md-7">
            <h1 class="user-name">{{ $user->name }}</h1>
            <p class="user-email"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="user-role"><strong>Vai trò:</strong> {{ $user->role === 'admin' ? 'Admin' : 'Người dùng' }}</p>
            <p class="user-joined"><strong>Ngày tham gia:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            <div class="col-md-7">
                <br>
            </div>
            <div class="mb-3">
                <a href="{{ route('showUser.edit', $user->id) }}" class="btn btn-warning w-100">Sửa</a>
                <br />
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">Xóa tài khoản</button>
                </form>
                <br />
                <a href="{{ route('products.index') }}" class="btn btn-secondary w-100">Về trang sản phẩm</a>
            </div>
        </div>
    </div>
</div>
@endsection