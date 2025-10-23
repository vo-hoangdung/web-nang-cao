@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-success mb-4">🧾 Xác nhận Thanh toán</h2>

        @if(empty($cart))
            <div class="alert alert-warning text-center">
                Giỏ hàng của bạn đang trống 😢
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('user.menu') }}" class="btn btn-success">🍴 Quay lại thực đơn</a>
            </div>
        @else
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Tên món</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="text-end mt-3">
                Tổng cộng: 
                <span class="text-success fw-bold">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
            </h4>

            {{-- Thông tin người nhận hàng --}}
            <form action="{{ route('cart.checkout') }}" method="POST" class="mt-4">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Họ và tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập họ tên người nhận" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Địa chỉ giao hàng</label>
                    <textarea name="address" class="form-control" rows="3" placeholder="Nhập địa chỉ nhận hàng" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Phương thức thanh toán</label>
                    <select name="payment_method" class="form-select" required>
                        <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                        <option value="bank">Chuyển khoản ngân hàng</option>
                    </select>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4"> Xác nhận thanh toán</button>
                    <a href="{{ route('cart.index') }}" class="btn btn-secondary px-4">Quay lại giỏ hàng</a>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
