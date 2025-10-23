@extends('layouts.app')

@section('title', 'FoodShop - Trang Chủ')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .hero-section {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .hero-description {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.8;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        text-align: center;
        margin: 60px 0 40px;
        position: relative;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: #28a745;
        margin: 15px auto 0;
        border-radius: 2px;
    }

    .featured-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .featured-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .featured-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .featured-card:hover img {
        transform: scale(1.05);
    }

    .featured-card .card-body {
        padding: 20px;
        text-align: center;
    }

    .featured-card h5 {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .featured-card p {
        color: #718096;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .price-tag {
        font-size: 1.3rem;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 15px;
    }

    .btn-featured {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        transition: transform 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-featured:hover {
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    .info-section {
        background: white;
        padding: 60px 0;
        margin: 40px 0;
    }

    .info-card {
        text-align: center;
        padding: 30px 20px;
        border-radius: 15px;
        background: #f8f9fa;
        margin-bottom: 30px;
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
    }

    .info-icon {
        font-size: 3rem;
        color: #28a745;
        margin-bottom: 20px;
    }

    .info-card h4 {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .info-card p {
        color: #718096;
        line-height: 1.6;
    }

    .cta-section {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .cta-description {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .btn-cta {
        background: white;
        color: #28a745;
        padding: 15px 30px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
        transition: transform 0.2s ease;
        display: inline-block;
    }

    .btn-cta:hover {
        transform: translateY(-2px);
        color: #28a745;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .featured-card img {
            height: 160px;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1 class="hero-title">FoodShop</h1>
        <p class="hero-subtitle">Hương vị truyền thống, chất lượng hiện đại</p>
        <p class="hero-description">
            Chúng tôi mang đến những món ăn ngon nhất với nguyên liệu tươi ngon, 
            được chế biến bởi những đầu bếp giàu kinh nghiệm.
        </p>
    </div>
</div>

<!-- Sản phẩm nổi bật -->
<div class="container">
    <h2 class="section-title">Món Ăn Nổi Bật</h2>
    
    <div class="row">
        @forelse($featuredFoods as $food)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card featured-card">
                    @if($food->image && file_exists(public_path('storage/' . $food->image)))
                        <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}">
                    @else
                        <div style="height: 200px; background-color: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #718096;">
                            <i class="fas fa-image" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5>{{ $food->name }}</h5>
                        <p>{{ Str::limit($food->description, 80) }}</p>
                        <div class="price-tag">{{ number_format($food->price, 0, ',', '.') }} VNĐ</div>
                        <a href="{{ route('user.menu') }}" class="btn-featured">Xem Thêm</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Chưa có món ăn nào</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Thông tin cửa hàng -->
<div class="info-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h4>Món Ăn Ngon</h4>
                    <p>Chúng tôi sử dụng nguyên liệu tươi ngon nhất để tạo ra những món ăn đậm đà hương vị truyền thống.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>Phục Vụ Nhanh</h4>
                    <p>Đội ngũ nhân viên chuyên nghiệp, phục vụ nhanh chóng và tận tình để mang đến trải nghiệm tốt nhất.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Chất Lượng Cao</h4>
                    <p>Cam kết mang đến những món ăn chất lượng cao với giá cả hợp lý, phù hợp với mọi đối tượng khách hàng.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="cta-section">
    <div class="container">
        <h2 class="cta-title">Khám Phá Thực Đơn</h2>
        <p class="cta-description">Xem toàn bộ món ăn ngon của chúng tôi</p>
        <a href="{{ route('user.menu') }}" class="btn-cta">Xem Thực Đơn</a>
    </div>
</div>

<!-- Font Awesome -->
@section('scripts')
    <script>
        const fa = document.createElement('link');
        fa.rel = 'stylesheet';
        fa.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css';
        document.head.appendChild(fa);
    </script>
@endsection
@endsection
