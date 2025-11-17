<x-admin-layout>
    {{-- Gửi Tiêu đề sang layout --}}
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h2">Quản lý Sản Phẩm</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Thêm Sản Phẩm Mới
            </a>
        </div>
    </x-slot>

    {{-- Nội dung chính --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Danh Mục</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Tồn Kho</th>
                            <th scope="col" class="text-end">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ $product->image_url ?? 'https://via.placeholder.com/60' }}" alt="{{ $product->name }}" 
                                         class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $product->category->name ?? 'N/A' }}</span>
                                </td>
                                <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $product->stock }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Chưa có sản phẩm nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-admin-layout>