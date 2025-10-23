@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Sửa món ăn</h2>

    <form action="{{ route('foods.update', $food) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên món</label>
            <input type="text" name="name" value="{{ $food->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control">{{ $food->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" value="{{ $food->price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ảnh</label>
            <input type="file" name="image" class="form-control">
            @if($food->image)
                <img src="{{ asset('storage/' . $food->image) }}" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('foods.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
