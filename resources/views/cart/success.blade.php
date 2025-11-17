<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt Hàng Thành Công - Cỏ Sài Gòn</title>

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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 text-center p-4 p-md-5">
                    <div class="card-body">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                        <h1 class="mt-3 fw-bold">Đặt Hàng Thành Công!</h1>
                        <p class="lead text-muted">Cảm ơn bạn đã tin tưởng Cỏ Sài Gòn.</p>
                        <p>Đơn hàng của bạn đã được ghi nhận với mã <strong class="text-primary">#{{ $order->id ?? 'N/A' }}</strong>. Chúng tôi sẽ xử lý và giao hàng cho bạn trong thời gian sớm nhất.</p>
                        <div class="mt-4">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Tiếp tục mua sắm</a>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary ms-2">Xem chi tiết đơn hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>