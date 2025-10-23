<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodShop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #fff !important;
            text-decoration: underline;
        }
        .navbar-nav .nav-link {
            margin: 0 10px;
        }
        .user-info {
            color: #fff;
            margin-right: 15px;
        }
        .btn-logout {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background: rgba(255,255,255,0.3);
            color: #fff;
        }
        .btn-login {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: rgba(255,255,255,0.3);
            color: #fff;
        }
        .btn-register {
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(255,255,255,0.9);
            color: #28a745;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background: #fff;
            color: #28a745;
        }
    </style>
</head>
<body>
    {{-- Thanh menu chung --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-utensils me-2"></i>FoodShop
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Trang Chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">
                            <i class="fas fa-info-circle me-1"></i>Giới Thiệu
                        </a>
                    </li>
                    @if(session('user'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.menu') }}">
                                <i class="fas fa-book me-1"></i>Thực Đơn
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i>Giỏ Hàng
                            </a>
                        </li>
                        @if(session('user')->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('foods.index') }}">
                                    <i class="fas fa-cog me-1"></i>Quản Lý
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
                
                <div class="d-flex align-items-center">
                    @if(session('user'))
                        <span class="user-info">
                            <i class="fas fa-user me-1"></i>
                            Xin chào, <strong>{{ session('user')->username }}</strong>
                        </span>
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-logout">
                            <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-login">
                            <i class="fas fa-sign-in-alt me-1"></i>Đăng nhập
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-register">
                            <i class="fas fa-user-plus me-1"></i>Đăng ký
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- Nội dung từng trang --}}
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Font Awesome --}}
    <script>
        const fa = document.createElement('link');
        fa.rel = 'stylesheet';
        fa.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css';
        document.head.appendChild(fa);
    </script>
    
    @yield('scripts')
</body>
</html>
