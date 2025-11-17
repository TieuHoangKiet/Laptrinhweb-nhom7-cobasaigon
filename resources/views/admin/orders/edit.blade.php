<!-- resources/views/admin/products/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Chỉnh sửa sản phẩm: ' . $product->name)

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chỉnh Sửa Sản Phẩm: {{ $product->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Giá (VNĐ)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                </div>
                <div class="form-group">
                    <label for="stock_quantity">Số lượng tồn kho</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required min="0">
                </div>
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Hình ảnh sản phẩm (Hiện tại)</label><br>
                    @if($product->image_path)
                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" width="150" class="img-thumbnail mb-2">
                    @else
                        <p>Không có hình ảnh</p>
                    @endif
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                    <small class="form-text text-muted">Chọn ảnh mới để thay thế ảnh hiện tại.</small>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Kích hoạt
                    </label>
                </div>
                 <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="is_featured" name="is_featured" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">
                        Nổi bật
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection