<x-admin-layout>
    {{-- Gửi Tiêu đề sang layout --}}
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h2">Quản lý Danh Mục</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Thêm Danh Mục Mới
            </a>
        </div>
    </x-slot>

    {{-- Nội dung chính (Slot) --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên Danh Mục</th>
                            <th scope="col">Mô Tả</th>
                            <th scope="col" class="text-end">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td><strong>{{ $category->id }}</strong></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description ?? 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
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
                                <td colspan="4" class="text-center">Chưa có danh mục nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>

        </div>
    </div>
</x-admin-layout>