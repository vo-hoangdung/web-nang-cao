@extends('layouts.app')

@section('content')
<style>
    /* General container styling */
    .food-list-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 15px;
    }

    /* Header styling */
    .page-header {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .page-header::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: #38a169;
        margin: 0.5rem auto;
        border-radius: 2px;
    }

    /* Action bar styling */
    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    /* Success alert styling */
    .alert-success {
        background: #d4f4e2;
        color: #2f855a;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Table container styling */
    .table-container {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    /* Table styling */
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead {
        background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
        color: #ffffff;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.05em;
    }

    .table th {
        padding: 1rem;
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid #e2e8f0;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        text-align: center;
        border-bottom: 1px solid #edf2f7;
    }

    .table-hover tbody tr {
        transition: background-color 0.3s ease;
    }

    .table-hover tbody tr:hover {
        background-color: #f7fafc;
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* Food image styling */
    .food-img {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #e2e8f0;
        transition: transform 0.3s ease;
    }

    .food-img:hover {
        transform: scale(1.05);
    }

    /* Button styling */
    .btn {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-success {
        background: #38a169;
        border: none;
        color: #ffffff;
    }

    .btn-success:hover {
        background: #2f855a;
        transform: translateY(-1px);
    }

    .btn-warning {
        background: #f6c107;
        border: none;
        color: #1a202c;
    }

    .btn-warning:hover {
        background: #d4a007;
        transform: translateY(-1px);
    }

    .btn-danger {
        background: #dc3545;
        border: none;
        color: #ffffff;
    }

    .btn-danger:hover {
        background: #c5303e;
        transform: translateY(-1px);
    }

    /* Empty state styling */
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: #718096;
        font-style: italic;
        font-size: 1.1rem;
        background: #f7fafc;
        border-radius: 8px;
        margin-top: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 0.9rem;
            padding: 0.75rem;
        }

        .food-img {
            width: 60px;
            height: 60px;
        }

        .action-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="food-list-container">
    <h1 class="page-header">Danh sách món ăn</h1>
    
    <div class="action-bar">
        <a href="{{ route('foods.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Thêm món mới
        </a>
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
    </div>

    {{-- ✅ Bộ lọc danh mục --}}
    <form method="GET" action="{{ route('foods.index') }}" class="mb-4 text-center">
        <label for="category" class="fw-bold me-2">Lọc theo danh mục:</label>
        <select name="category" id="category" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
            <option value="">Tất cả</option>
            @foreach(['Cơm', 'Nước', 'Phở', 'Đồ ăn nhanh', 'Khác'] as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
    </form>

    <div class="table-container">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 25%;">Tên món</th>
                    <th style="width: 15%;">Giá</th>
                    <th style="width: 20%;">Ảnh</th>
                    <th style="width: 20%;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($foods as $food)
                <tr>
                    <td><strong>{{ $food->name }}</strong></td>
                    <td>{{ number_format($food->price, 0, ',', '.') }} VNĐ</td>
                    <td>
                        @if($food->image)
                            <img src="{{ asset('storage/' . $food->image) }}" class="food-img" alt="{{ $food->name }}">
                        @else
                            <span class="text-muted fst-italic">Chưa có ảnh</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('foods.edit', $food) }}" class="btn btn-warning btn-sm me-2">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <form action="{{ route('foods.destroy', $food) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa món này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($foods->isEmpty())
            <div class="empty-state">
                <i class="fas fa-utensils me-2"></i> Chưa có món ăn nào trong danh sách.
            </div>
        @endif
    </div>
</div>

@section('scripts')
    <script>
        // Add Font Awesome for icons
        const fontAwesome = document.createElement('link');
        fontAwesome.rel = 'stylesheet';
        fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
        document.head.appendChild(fontAwesome);
    </script>
@endsection
@endsection
