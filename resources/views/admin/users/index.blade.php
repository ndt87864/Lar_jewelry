@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Danh sách tài khoản</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Thêm tài khoản</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Cấp bậc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}
                        @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="img-fluid"
                            width="50">
                        @else
                            <img src="{{ asset('storage/products/no.jpg') }}" alt="Chưa có hình ảnh" class="img-fluid"
                            width="50">
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role === 'admin' ? 'Admin' : 'Người dùng' }}</td> <!-- Kiểm tra role -->
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection