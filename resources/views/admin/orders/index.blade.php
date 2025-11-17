<x-admin-layout>
    {{-- Gửi Tiêu đề sang layout --}}
    <x-slot name="header">
        <h1 class="h2">Quản lý Đơn Hàng</h1>
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
                            <th scope="col">Mã ĐH</th>
                            <th scope="col">Khách Hàng</th>
                            <th scope="col">Ngày Đặt</th>
                            <th scope="col">Tổng Tiền</th>
                            <th scope="col">Trạng Thái</th>
                            <th scope="col" class="text-end">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    {{-- Hiển thị status cho đẹp --}}
                                    @if ($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                    @elseif ($order->status == 'processing')
                                        <span class="badge bg-info">Đang xử lý</span>
                                    @elseif ($order->status == 'shipped')
                                        <span class="badge bg-success">Đã giao</span>
                                    @elseif ($order->status == 'cancelled')
                                        <span class="badge bg-danger">Đã hủy</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    {{-- NÚT XÁC NHẬN MÀ BẠN MUỐN --}}
                                    @if ($order->status == 'pending')
                                        {{-- Dùng form để gửi PUT request --}}
                                        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="processing">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="bi bi-check-lg me-1"></i> Xác nhận
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye-fill"></i> Xem
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Chưa có đơn hàng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</x-admin-layout>