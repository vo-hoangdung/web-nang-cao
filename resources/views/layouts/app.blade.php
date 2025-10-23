<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #198754;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    {{-- Thanh menu chung --}}
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.menu') }}"> FoodShop</a>
            <div>
                @if(session('user'))
                    <span class="text-white me-3">
                        Xin chào, <strong>{{ session('user')->username }}</strong>
                    </span>
                    <a href="{{ route('logout') }}" class="btn btn-sm btn-danger">Đăng xuất</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-light">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-warning">Đăng ký</a>
                @endif
            </div>
        </div>
    </nav>

    {{-- Nội dung từng trang --}}
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
