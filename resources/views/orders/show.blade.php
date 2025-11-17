<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi Tiết Đơn Hàng #{{ $order->id }} - Cỏ Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f8f9fa; }
        .product-image-sm { width: 60px; height: 60px; object-fit: cover; }
    </style>
</head>
<body>

    <x-header />

    <main class="container py-5">
        <h1 class="text-center mb-2 fw-bold">Chi Tiết Đơn Hàng</h1>
        <p class="text-center text-muted mb-4">Mã đơn hàng: <strong class="text-primary">#{{ $order->id }}</strong></p>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">Sản phẩm đã đặt</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="p-3">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/100' }}" alt="{{ $item->product->name ?? 'Sản phẩm đã bị xóa' }}" class="product-image-sm rounded me-3">
                                                <div>
                                                    <h6 class="mb-0 fw-semibold">{{ $item->product->name ?? 'Sản phẩm đã bị xóa' }}</h6>
                                                    <small class="text-muted">Giá: {{ number_format($item->price, 0, ',', '.') }} VNĐ</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">x {{ $item->quantity }}</td>
                                        <td class="text-end pe-3">
                                            <strong class="text-dark">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</strong>
                                        </td>
                                    </tr>
                                @endforeach
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

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">Thông tin nhận hàng</h5>
                    </div>
                    <div class="card-body p-4">
                        <p class="mb-1"><strong>Họ tên:</strong> {{ $order->name }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                        <p class="mb-1"><strong>Điện thoại:</strong> {{ $order->phone }}</p>
                        <p class="mb-0"><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
             <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i> Quay lại danh sách
            </a>
        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>