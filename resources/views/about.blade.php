@extends('layouts.app')

@section('title', 'FoodShop - Giới Thiệu')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .about-hero {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
    }

    .about-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .about-subtitle {
        font-size: 1.3rem;
        opacity: 0.9;
    }

    .content-section {
        padding: 60px 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        text-align: center;
        margin-bottom: 50px;
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

    .story-card {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .story-card h3 {
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    .story-card p {
        color: #718096;
        line-height: 1.8;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .value-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-5px);
    }

    .value-icon {
        font-size: 3rem;
        color: #28a745;
        margin-bottom: 20px;
    }

    .value-card h4 {
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 1.3rem;
    }

    .value-card p {
        color: #718096;
        line-height: 1.6;
    }

    .team-section {
        background: white;
        padding: 60px 0;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .team-card {
        text-align: center;
        padding: 30px 20px;
        border-radius: 15px;
        background: #f8f9fa;
        transition: transform 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-5px);
    }

    .team-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
    }

    .team-card h4 {
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .team-card p {
        color: #718096;
        font-style: italic;
    }

    .contact-section {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
    }

    .contact-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .contact-item {
        padding: 20px;
    }

    .contact-item i {
        font-size: 2rem;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .contact-item h5 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .contact-item p {
        opacity: 0.8;
    }

    @media (max-width: 768px) {
        .about-title {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .story-card {
            padding: 30px 20px;
        }
    }
</style>

<!-- Hero Section -->
<div class="about-hero">
    <div class="container">
        <h1 class="about-title">Về FoodShop</h1>
        <p class="about-subtitle">Câu chuyện của nhà hàng và niềm đam mê ẩm thực</p>
    </div>
</div>

<!-- Câu chuyện -->
<div class="content-section">
    <div class="container">
        <h2 class="section-title">Câu Chuyện Của Chúng Tôi</h2>
        
        <div class="story-card">
            <h3>Khởi Đầu Từ Niềm Đam Mê</h3>
            <p>
                FoodShop được thành lập vào năm 2020 với mong muốn mang đến những món ăn ngon nhất 
                cho cộng đồng. Chúng tôi bắt đầu từ một quán ăn nhỏ với chỉ vài món ăn đơn giản, 
                nhưng luôn đặt chất lượng và hương vị lên hàng đầu.
            </p>
            <p>
                Với niềm đam mê ẩm thực và sự tận tâm trong từng món ăn, chúng tôi đã dần phát triển 
                thành một nhà hàng được nhiều khách hàng yêu mến và tin tưởng.
            </p>
        </div>

        <div class="story-card">
            <h3>Triết Lý Kinh Doanh</h3>
            <p>
                Chúng tôi tin rằng một món ăn ngon không chỉ đến từ nguyên liệu tươi ngon mà còn từ 
                tình yêu và sự chăm chút trong từng công đoạn chế biến. Mỗi món ăn đều được chuẩn bị 
                với tất cả tâm huyết của đội ngũ đầu bếp giàu kinh nghiệm.
            </p>
            <p>
                Chúng tôi cam kết mang đến trải nghiệm ẩm thực tuyệt vời nhất cho mọi khách hàng, 
                từ những món ăn truyền thống đến những món ăn hiện đại, tất cả đều được chế biến 
                với tiêu chuẩn chất lượng cao nhất.
            </p>
        </div>
    </div>
</div>

<!-- Giá trị cốt lõi -->
<div class="team-section">
    <div class="container">
        <h2 class="section-title">Giá Trị Cốt Lõi</h2>
        
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4>Tươi Ngon</h4>
                <p>Chúng tôi chỉ sử dụng nguyên liệu tươi ngon nhất, được lựa chọn kỹ càng từ những nhà cung cấp uy tín.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h4>Tận Tâm</h4>
                <p>Mỗi món ăn đều được chế biến với tất cả tình yêu và sự chăm chút của đội ngũ đầu bếp.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h4>Phục Vụ</h4>
                <p>Đội ngũ nhân viên chuyên nghiệp, nhiệt tình, luôn sẵn sàng phục vụ khách hàng một cách tốt nhất.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h4>Chất Lượng</h4>
                <p>Cam kết mang đến những món ăn chất lượng cao với giá cả hợp lý, phù hợp với mọi đối tượng.</p>
            </div>
        </div>
    </div>
</div>

<!-- Đội ngũ -->
<div class="content-section">
    <div class="container">
        <h2 class="section-title">Đội Ngũ Của Chúng Tôi</h2>
        
        <div class="team-grid">
            <div class="team-card">
                <div class="team-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h4>Nguyễn Văn A</h4>
                <p>Bếp Trưởng</p>
            </div>
            
            <div class="team-card">
                <div class="team-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h4>Trần Thị B</h4>
                <p>Quản Lý</p>
            </div>
            
            <div class="team-card">
                <div class="team-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h4>Lê Văn C</h4>
                <p>Đầu Bếp</p>
            </div>
            
            <div class="team-card">
                <div class="team-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h4>Phạm Thị D</h4>
                <p>Nhân Viên Phục Vụ</p>
            </div>
        </div>
    </div>
</div>

<!-- Thông tin liên hệ -->
<div class="contact-section">
    <div class="container">
        <h2 class="section-title" style="color: white;">Liên Hệ Với Chúng Tôi</h2>
        
        <div class="contact-info">
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <h5>Địa Chỉ</h5>
                <p>123 Đường ABC, Quận XYZ<br>Thành phố Hồ Chí Minh</p>
            </div>
            
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <h5>Điện Thoại</h5>
                <p>0123 456 789<br>0987 654 321</p>
            </div>
            
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <h5>Email</h5>
                <p>info@foodshop.com<br>support@foodshop.com</p>
            </div>
            
            <div class="contact-item">
                <i class="fas fa-clock"></i>
                <h5>Giờ Mở Cửa</h5>
                <p>Thứ 2 - Chủ Nhật<br>6:00 - 22:00</p>
            </div>
        </div>
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
