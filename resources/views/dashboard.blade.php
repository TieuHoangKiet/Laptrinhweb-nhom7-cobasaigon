<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bảng Điều Khiển - Cỏ Sài Gòn</title>

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
        <h1 class="text-center mb-4 fw-bold">Bảng Điều Khiển</h1>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="fw-semibold">Chào mừng, {{ Auth::user()->name }}!</h4>
                        <p class="text-muted">Đây là trang quản lý cá nhân của bạn.</p>
                        
                        <div class="alert alert-success mt-3" role="alert">
                            {{ __("You're logged in!") }}
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-person-circle fs-1 text-primary"></i>
                                <h5 class="mt-3">Hồ Sơ Của Bạn</h5>
                                <p class="text-muted small">Xem và cập nhật thông tin cá nhân, mật khẩu của bạn.</p>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Quản lý Hồ Sơ</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-box-seam fs-1 text-success"></i>
                                <h5 class="mt-3">Đơn Hàng Của Tôi</h5>
                                <p class="text-muted small">Theo dõi lịch sử mua hàng và trạng thái các đơn hàng đã đặt.</p>
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-success">Xem Đơn Hàng</a>
                            </div>
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