@extends('layouts.app')

@section('content')
<style>
    /* Tổng thể giỏ hàng */
    .cart-wrapper {
        max-width: 1100px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        overflow: hidden;
        padding: 30px;
    }

    h2.cart-title {
        font-weight: 700;
        color: #198754;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Bảng giỏ hàng */
    .cart-table thead {
        background-color: #198754;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .cart-table th, .cart-table td {
        text-align: center;
        vertical-align: middle;
    }

    .cart-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    /*Nút tăng giảm */
    .btn-qty {
        background-color: #198754;
        border: none;
        color: white;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.2s ease-in-out;
    }

    .btn-qty:hover {
        background-color: #157347;
    }

    /* Nút xóa */
    .btn-remove {
        background-color: #dc3545;
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        transition: 0.2s;
    }

    .btn-remove:hover {
        background-color: #b02a37;
    }

    /* Tổng tiền */
    .total-box {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px 25px;
        font-size: 18px;
        font-weight: 600;
        color: #333;
        text-align: right;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .total-box .price {
        color: #198754;
        font-size: 20px;
        font-weight: 700;
    }

    /*Nút hành động */
    .cart-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-checkout {
        background-color: #0d6efd;
        border: none;
        padding: 10px 25px;
        font-size: 16px;
        border-radius: 8px;
        color: white;
        transition: all 0.2s ease-in-out;
    }

    .btn-checkout:hover {
        background-color: #0b5ed7;
    }

    .btn-continue {
        background-color: #6c757d;
        color: white;
        padding: 10px 25px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-continue:hover {
        background-color: #5a6268;
        color: white;
    }

    /*Giỏ hàng trống */
    .cart-empty {
        text-align: center;
        background: #f8f9fa;
        border-radius: 12px;
        padding: 60px 30px;
        color: #6c757d;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .cart-empty p {
        font-size: 18px;
        margin-bottom: 20px;
    }
    tbody tr:hover {
        background-color: #f2fef6;
        transition: 0.2s;
    }
    @media (max-width: 768px) {
        .cart-wrapper {
            padding: 20px;
        }
        .cart-img {
            width: 70px;
            height: 70px;
        }
    }
</style>

<div class="container">
    <div class="cart-wrapper">
        <h2 class="cart-title"> Giỏ hàng của bạn</h2>

        {{-- Thông báo thành công --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        {{-- Nếu giỏ hàng có sản phẩm --}}
        @if(!empty($cart))
        <div class="table-responsive">
            <table class="table table-bordered cart-table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên món</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php 
                            $subtotal = $item['price'] * $item['quantity']; 
                            $total += $subtotal; 
                        @endphp
                        <tr>
                            <td><img src="{{ asset('storage/' . $item['image']) }}" class="cart-img" alt="{{ $item['name'] }}"></td>
                            <td><strong>{{ $item['name'] }}</strong></td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button name="action" value="decrease" class="btn-qty">−</button>
                                    <span class="mx-2 fw-bold">{{ $item['quantity'] }}</span>
                                    <button name="action" value="increase" class="btn-qty">+</button>
                                </form>
                            </td>
                            <td><strong>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</strong></td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa món này khỏi giỏ hàng?');">
                                    @csrf
                                    <button class="btn-remove"> Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tổng tiền và hành động --}}
        <div class="total-box mt-3">
            Tổng cộng: <span class="price">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
        </div>

        <div class="cart-actions">
            <a href="{{ route('user.menu') }}" class="btn-continue">🍴 Tiếp tục chọn món</a>
            <a href="{{ route('checkout.index') }}" class="btn-checkout">✅ Thanh toán ngay</a>
        </div>

        @else
        {{-- Giỏ hàng trống --}}
        <div class="cart-empty">
            <p>Giỏ hàng của bạn hiện đang trống 😢</p>
            <a href="{{ route('user.menu') }}" class="btn btn-success mt-3">🍴 Quay lại thực đơn</a>
        </div>
        @endif
    </div>
</div>
@endsection
