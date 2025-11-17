<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đơn Hàng Của Tôi - Cỏ Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f8f9fa; }
    </style>
</head>
<body>

    <x-header />

    <main class="container py-5">
        <h1 class="text-center mb-4 fw-bold">Đơn Hàng Của Tôi</h1>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Mã ĐH</th>
                                <th scope="col">Ngày Đặt</th>
                                <th scope="col">Tổng Tiền</th>
                                <th scope="col">Trạng Thái</th>
                                <th scope="col" class="pe-4">Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="ps-4"><strong>#{{ $order->id }}</strong></td>
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
                                    <td class="pe-4">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye-fill me-1"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4">
                                        <p class="mb-0 text-muted">Bạn chưa có đơn hàng nào.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($orders->hasPages())
                <div class="card-footer bg-white">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>