@extends('layouts.app')

@section('content')
<style>
    .container h2 {
        font-weight: 700;
        color: #2f855a;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #cbd5e0;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #38a169;
        box-shadow: 0 0 0 0.15rem rgba(56, 161, 105, 0.25);
    }

    .btn-primary {
        background: #38a169;
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: #2f855a;
        transform: translateY(-1px);
    }

    .btn-secondary {
        border-radius: 10px;
        padding: 0.5rem 1.5rem;
    }

    label {
        font-weight: 600;
        color: #2d3748;
    }

    small.text-muted {
        display: block;
        margin-top: 5px;
        margin-bottom: 5px;
    }
</style>

<div class="container mt-4">
    <h2>Thêm món ăn</h2>

    <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Tên món --}}
        <div class="mb-3">
            <label for="name">Tên món</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        {{-- Mô tả --}}
        <div class="mb-3">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        {{-- Danh mục --}}
        <div class="mb-3">
            <label>Danh mục</label>
            <select name="category" class="form-control" id="categorySelect">
                <option value="">-- Chọn danh mục có sẵn --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>

            <small class="text-muted">Hoặc nhập danh mục mới:</small>
            <input type="text" name="new_category" class="form-control mt-2" placeholder="Nhập danh mục mới (nếu có)">
        </div>

        {{-- Giá --}}
        <div class="mb-3">
            <label for="price">Giá</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>

        {{-- Ảnh --}}
        <div class="mb-3">
            <label for="image">Ảnh món ăn</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('foods.index') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
</div>
@endsection
