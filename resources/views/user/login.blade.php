<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <style>
        /* Toàn trang */
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        /* Khung chính */
        .login-container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            width: 380px;
            text-align: center;
            animation: fadeIn 0.6s ease;
        }

        /* Tiêu đề */
        .login-container h2 {
            margin-bottom: 25px;
            color: #2d3436;
            font-size: 28px;
            letter-spacing: 0.5px;
        }

        /* Input và label */
        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #636e72;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #dfe6e9;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.25s;
        }

        .form-group input:focus {
            border-color: #0984e3;
            box-shadow: 0 0 5px rgba(9, 132, 227, 0.4);
            outline: none;
        }

        /* Nút đăng nhập */
        .btn {
            background: #0984e3;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.25s ease;
            width: 100%;
        }

        .btn:hover {
            background: #74b9ff;
        }

        /* Link đăng ký */
        .register-link {
            margin-top: 18px;
            font-size: 14px;
            color: #2d3436;
        }

        .register-link a {
            color: #0984e3;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Thông báo */
        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-success {
            background: #dfe6e9;
            color: #00b894;
        }

        .alert-error {
            background: #ffe6e6;
            color: #d63031;
        }

        ul.error-list {
            text-align: left;
            color: #d63031;
            font-size: 14px;
            margin-top: -5px;
            padding-left: 20px;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Đăng nhập tài khoản</h2>

        {{-- Thông báo --}}
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Lỗi validate --}}
        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Form đăng nhập --}}
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email của bạn" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>

            <button type="submit" class="btn">Đăng nhập</button>
        </form>

        <div class="register-link">
            Chưa có tài khoản?
            <a href="{{ route('register') }}">Đăng ký ngay</a>
        </div>
    </div>
</body>
</html>
