<x-admin-layout>
    {{-- Gửi Tiêu đề sang layout --}}
    <x-slot name="header">
        <h1 class="h2">Chỉnh Sửa Sản Phẩm</h1>
    </x-slot>

    {{-- Nội dung chính (Slot) --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Tên Sản Phẩm</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" 
                           value="{{ old('name', $product->name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-semibold">Danh Mục</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" 
                            id="category_id" name="category_id" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">Giá (VNĐ)</label>
                    <input type="number" 
                           class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" 
                           value="{{ old('price', $product->price) }}" 
                           required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label fw-semibold">Số lượng Tồn Kho</label>
                    <input type="number" 
                           class="form-control @error('stock') is-invalid @enderror" 
                           id="stock" name="stock" 
                           value="{{ old('stock', $product->stock) }}" 
                           required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label fw-semibold">Đường dẫn Ảnh (URL)</label>
                    <input type="url" 
                           class="form-control @error('image_url') is-invalid @enderror" 
                           id="image_url" name="image_url" 
                           value="{{ old('image_url', $product->image_url) }}"
                           placeholder="https://example.com/image.jpg">
                    @error('image_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Mô Tả (Tùy chọn)</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Hủy bỏ
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Cập Nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>