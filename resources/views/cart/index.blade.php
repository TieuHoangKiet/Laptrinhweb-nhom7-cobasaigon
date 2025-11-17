<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ Hàng - Cỏ Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f8f9fa; }
        .product-image { width: 100px; height: 100px; object-fit: cover; }
        .quantity-input { width: 80px; }
    </style>
</head>
<body>

    <x-header />

    <main class="container py-5">
        <h1 class="text-center mb-4 fw-bold">Giỏ Hàng Của Bạn</h1>

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

        @if (count($cartItems) > 0)
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Sản Phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Tạm Tính</th>
                                <th scope="col" class="pe-4">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item['image_url'] ?? 'https://via.placeholder.com/100' }}" alt="{{ $item['name'] }}" class="product-image rounded me-3">
                                            <div>
                                                <h6 class="mb-0 fw-semibold">{{ $item['name'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control text-center quantity-input" onchange="this.form.submit()">
                                            {{-- Nút submit ẩn, onchange sẽ tự động gửi form --}}
                                            <button type="submit" class="btn btn-primary btn-sm ms-2 d-none">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td>
                                        <strong class="text-dark">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</strong>
                                    </td>
                                    <td class="pe-4">
                                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row justify-content-end mt-4">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Tổng Giỏ Hàng</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Tổng phụ</span>
                                <strong>{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Giao hàng</span>
                                <strong>Miễn phí</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Tổng cộng</span>
                                <span class="text-danger">{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</span>
                            </div>
                            <a href="{{ route('cart.checkout') }}" class="btn btn-primary w-100 btn-lg mt-4">
                                Tiến hành thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-cart-x" style="font-size: 5rem; color: #6c757d;"></i>
                <h3 class="mt-3">Giỏ hàng của bạn đang trống</h3>
                <p class="text-muted">Hãy quay lại trang sản phẩm để lựa đồ nhé.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left me-2"></i> Quay lại mua sắm
                </a>
            </div>
        @endif
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>