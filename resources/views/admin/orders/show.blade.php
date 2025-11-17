<x-admin-layout>
    {{-- Gửi Tiêu đề sang layout --}}
    <x-slot name="header">
        <h1 class="h2">Chi Tiết Đơn Hàng</h1>
    </x-slot>

    {{-- Nội dung chính --}}
    <div class="pb-5">
        <div class="mb-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i> Quay lại danh sách
            </a>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">Sản phẩm đã đặt (Mã ĐH: #{{ $order->id }})</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-3">Sản phẩm</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col" class="pe-3 text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- ===== SỬA LỖI Ở ĐÂY: $order->items ===== --}}
                                @forelse ($order->items as $item)
                                    <tr>
                                        <td class="p-3">
                                            <div class="d-flex align-items-center">
                                                {{-- SỬA LỖI ẢNH: Dùng image_url --}}
                                                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/60' }}" 
                                                     alt="{{ $item->product->name ?? 'Sản phẩm đã xóa' }}" 
                                                     class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0 fw-semibold">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                        <td>x {{ $item->quantity }}</td>
                                        <td class="text-end pe-3">
                                            <strong class="text-dark">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</strong>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-4">Không có sản phẩm trong đơn hàng này.</td>
                                    </tr>
                                @endforelse
                                {{-- ======================================= --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">Tổng cộng</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tổng phụ</span>
                            <strong>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Giao hàng</span>
                            <strong>Miễn phí</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Tổng cộng</span>
                            <span class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</span>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">Thông tin khách hàng</h5>
                    </div>
                    <div class="card-body p-4">
                        <p class="mb-1"><strong>Họ tên:</strong> {{ $order->name }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                        <p class="mb-1"><strong>Điện thoại:</strong> {{ $order->phone }}</p>
                        <p class="mb-1"><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                        @if($order->notes)
                            <p class="mb-0"><strong>Ghi chú:</strong> {{ $order->notes }}</p>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">Cập nhật trạng thái</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái đơn hàng:</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</x-admin-layout>