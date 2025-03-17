@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sửa đơn hàng</h1>
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">Người dùng</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $order->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="total">Tổng tiền</label>
            <input type="number" name="total" id="total" class="form-control" value="{{ $order->total }}" required>
        </div>
        <div class="form-group">
            <label for="status">Trạng thái</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $order->status }}" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Phương thức thanh toán</label>
            <input type="text" name="payment_method" id="payment_method" class="form-control" value="{{ $order->payment_method }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
