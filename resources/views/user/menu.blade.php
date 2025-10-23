@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #121212;
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .menu-title {
        font-weight: 700;
        color: #fff;
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.4rem;
        letter-spacing: 0.5px;
        position: relative;
    }

    .menu-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: #28a745;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    /* Thanh tìm kiếm và lọc */
    .filter-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .search-input,
    .filter-select {
        background-color: #1e1e1e;
        color: #fff;
        border: 1px solid #2c2c2c;
        border-radius: 8px;
        padding: 10px 16px;
        min-width: 220px;
        transition: border-color 0.25s ease;
    }

    .search-input:focus,
    .filter-select:focus {
        outline: none;
        border-color: #28a745;
        box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.25);
    }

    .btn-filter {
        background-color: #28a745;
        border: none;
        border-radius: 8px;
        padding: 10px 18px;
        color: #fff;
        font-weight: 600;
        transition: background-color 0.25s ease, transform 0.2s ease;
    }

    .btn-filter:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    /* Card món ăn */
    .menu-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        background-color: #1e1e1e;
        color: #fff;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .menu-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 2px solid #2c2c2c;
        transition: opacity 0.3s ease;
    }

    .menu-card img:hover {
        opacity: 0.9;
    }

    .menu-card .card-body {
        padding: 16px;
        text-align: center;
    }

    .menu-card h5 {
        font-weight: 600;
        font-size: 1.15rem;
        margin-bottom: 6px;
        color: #fff;
    }

    .menu-card p {
        color: #b0b0b0;
        margin-bottom: 16px;
        font-size: 15px;
    }

    .btn-add {
        background-color: #28a745;
        border: none;
        font-weight: 600;
        color: #fff;
        padding: 8px 16px;
        border-radius: 8px;
        transition: background-color 0.25s ease, transform 0.2s ease;
        width: 100%;
    }

    .btn-add:hover {
        background-color: #218838;
        transform: translateY(-1px);
    }

    /* Thông báo */
    .alert {
        border-radius: 10px;
        font-weight: 500;
        padding: 12px 18px;
        text-align: center;
    }

    .alert-success {
        background: #d4f4e2;
        color: #1d7047;
    }

    .alert-danger {
        background: #f8d7da;
        color: #842029;
    }

    /* Trạng thái trống */
    .no-result {
        color: #b0b0b0;
        text-align: center;
        font-style: italic;
        margin-top: 40px;
        font-size: 1.1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .menu-card img {
            height: 160px;
        }

        .filter-bar {
            flex-direction: column;
            gap: 10px;
        }

        .search-input,
        .filter-select,
        .btn-filter {
            width: 100%;
        }
    }
</style>

<div class="container mt-4">
    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1 class="menu-title">Thực Đơn Hôm Nay</h1>

    {{-- Thanh tìm kiếm và lọc --}}
    <form method="GET" action="{{ route('user.menu') }}" class="filter-bar">
        <input type="text" name="search" class="search-input" placeholder=" Tìm món ăn..."
               value="{{ request('search') }}">

        <select name="category" class="filter-select">
            <option value="">Tất cả danh mục</option>
            @foreach(['Cơm', 'Nước', 'Phở', 'Đồ ăn nhanh', 'Khác'] as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn-filter">Lọc</button>
    </form>

    {{-- Danh sách món ăn --}}
    <div class="row justify-content-center">
        @forelse($foods as $food)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card menu-card shadow">
                    @if($food->image && file_exists(public_path('storage/' . $food->image)))
                        <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}">
                    @else
                        <div style="height: 200px; background-color: #2c2c2c; display: flex; align-items: center; justify-content: center; color: #666;">
                            <i class="fas fa-image" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5>{{ $food->name }}</h5>
                        <p>{{ number_format($food->price, 0, ',', '.') }} VNĐ</p>

                        <form action="{{ route('cart.add', $food->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-add">
                                <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="no-result">Không tìm thấy món ăn nào phù hợp.</p>
        @endforelse
    </div>
</div>

{{-- Font Awesome --}}
@section('scripts')
    <script>
        const fa = document.createElement('link');
        fa.rel = 'stylesheet';
        fa.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css';
        document.head.appendChild(fa);
    </script>
@endsection
@endsection
