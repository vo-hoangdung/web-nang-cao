<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>

    <style>
        /* Toàn trang */
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #81ecec, #74b9ff);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        /* Khung chính */
        .register-container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            width: 420px;
            text-align: center;
            animation: fadeIn 0.6s ease;
        }

        /* Tiêu đề */
        .register-container h2 {
            margin-bottom: 25px;
            color: #2d3436;
            font-size: 28px;
            letter-spacing: 0.5px;
        }

        /* Form */
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
            border-color: #00cec9;
            box-shadow: 0 0 6px rgba(0, 206, 201, 0.4);
            outline: none;
        }

        /* Nút đăng ký */
        .btn {
            background: #00cec9;
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
            background: #55efc4;
        }

        /* Link đăng nhập */
        .login-link {
            margin-top: 18px;
            font-size: 14px;
            color: #2d3436;
        }

        .login-link a {
            color: #00cec9;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
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

        /* Hiệu ứng */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Tạo tài khoản mới</h2>

        {{-- Thông báo thành công --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Hiển thị lỗi validate --}}
        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Form đăng ký --}}
        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <div class="form-group">
                <label for="username">Tên đăng nhập <span style="color:red">*</span></label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Nhập tên đăng nhập" required>
            </div>

            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên (không bắt buộc)">
            </div>

            <div class="form-group">
                <label for="email">Email <span style="color:red">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập địa chỉ email" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu <span style="color:red">*</span></label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu <span style="color:red">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
            </div>

            <button type="submit" class="btn">Đăng ký</button>
        </form>

        <div class="login-link">
            Đã có tài khoản?
            <a href="{{ route('login') }}">Đăng nhập ngay</a>
        </div>
    </div>
</body>
</html>
