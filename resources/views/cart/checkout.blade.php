<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh Toán - Cỏ Sài Gòn</title>

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
        <h1 class="text-center mb-4 fw-bold">Hoàn Tất Đơn Hàng</h1>
        
        {{-- ===== PHẦN SỬA 1: HIỂN THỊ LỖI ===== --}}
        
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h5 class="alert-heading">Vui lòng kiểm tra lại thông tin:</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- ===== KẾT THÚC PHẦN SỬA 1 ===== --}}
        
        {{-- Thêm ID cho form để JS bắt sự kiện --}}
        <form action="{{ route('cart.processCheckout') }}" method="POST" id="checkout-form">
            @csrf
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h4 class="mb-3 fw-semibold">Thông tin nhận hàng</h4>
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và Tên</label>
                                {{-- Giữ lại giá trị cũ nếu validation fail --}}
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Nhập địa chỉ nhận hàng" required>{{ old('address') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Ghi chú (Tùy chọn)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Ghi chú thêm cho người giao hàng...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                        <div class="card-body p-4">
                            <h4 class="mb-3 fw-semibold">Tóm Tắt Đơn Hàng</h4>
                            <ul class="list-group list-group-flush mb-3">
                                @foreach ($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div>
                                            {{ $item['name'] }} 
                                            <small class="text-muted"> (x{{ $item['quantity'] }})</small>
                                        </div>
                                        <span class="text-dark">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</span>
                                    </li>
                                @endforeach
                            </ul>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                                <span>Tổng cộng</span>
                                <span class="text-danger">{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>

                            {{-- Thêm ID cho nút --}}
                            <button type="submit" class="btn btn-primary w-100 btn-lg mt-4" id="checkout-button">
                                {{-- Span cho text (để ẩn) --}}
                                <span id="button-text">
                                    <i class="bi bi-bag-check-fill me-2"></i> Xác Nhận Đặt Hàng
                                </span>
                                {{-- Span cho spinner (để hiện) --}}
                                <span class="spinner-border spinner-border-sm d-none" id="button-spinner" role="status" aria-hidden="true"></span>
                                <span id="button-processing-text" class="d-none">Đang xử lý...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ===== PHẦN SỬA 2: JAVASCRIPT CHO NÚT "ĐANG XỬ LÝ" ===== --}}
    <script>
        document.getElementById('checkout-form').addEventListener('submit', function() {
            var button = document.getElementById('checkout-button');
            var buttonText = document.getElementById('button-text');
            var buttonSpinner = document.getElementById('button-spinner');
            var buttonProcessingText = document.getElementById('button-processing-text');

            // Vô hiệu hóa nút để tránh bấm nhiều lần
            button.disabled = true;
            
            // Ẩn text gốc, hiện spinner và text "Đang xử lý"
            buttonText.classList.add('d-none');
            buttonSpinner.classList.remove('d-none');
            buttonProcessingText.classList.remove('d-none');
        });
    </script>
    {{-- ===== KẾT THÚC PHẦN SỬA 2 ===== --}}

</body>
</html>