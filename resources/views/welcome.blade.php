<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cỏ Sài Gòn - Trang Chủ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
        }
        .product-card img {
            height: 300px;
            object-fit: cover;
        }
        /* Cần thêm cái này để .stretched-link hoạt động đúng trong .card */
        .card {
            position: relative;
        }
        .hero-carousel-item {
            height: 60vh;
            min-height: 400px;
            background-size: cover;
            background-position: center;
        }
        .carousel-caption-custom {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 1.5rem;
            border-radius: 0.5rem;
        }
        .category-card {
            transition: transform 0.2s ease-in-out;
        }
        .category-card:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 3rem;
            color: var(--bs-primary);
        }
        .promo-card {
            background-size: cover;
            background-position: center;
            min-height: 250px;
            color: white;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
        }
    </style>
</head>
<body>

    <x-header />

    <header>
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active hero-carousel-item" style="background-image: url('{{ asset('images/banner-thoi-trang-dep.jpg') }}')">
                    <div class="container h-100 d-flex align-items-center justify-content-start">
                        <div class="carousel-caption-custom text-start">
                            <h1 class="display-4">Bộ Sưu Tập Mới</h1>
                            <p class="lead">Khám phá phong cách độc đáo chỉ có tại Cỏ Sài Gòn.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Mua Ngay</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item hero-carousel-item" style="background-image: url('https://via.placeholder.com/1920x800/6c757d/ffffff?text=Summer+Sale')">
                     <div class="container h-100 d-flex align-items-center justify-content-center">
                        <div class="carousel-caption-custom text-center">
                            <h1 class="display-4">Giảm Giá Mùa Hè</h1>
                            <p class="lead">Giảm giá lên đến 50% cho các sản phẩm chọn lọc.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg">Xem Ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>

    <section class="py-5" style="background-color: #fff3cd;">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold text-danger">⚡ Khuyến Mãi Sốc ⚡</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 shadow-sm border-0 rounded-3 promo-card" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6)), url('https://via.placeholder.com/400x250/dc3545/white?text=Giảm+50%')">
                            <div class="card-body d-flex flex-column justify-content-end p-4">
                                <h3 class="card-title fw-bold">GIẢM 50%</h3>
                                <p class="card-text">Áp dụng cho toàn bộ Áo Thun nam nữ.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 shadow-sm border-0 rounded-3 promo-card" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6)), url('https://via.placeholder.com/400x250/0d6efd/white?text=Mua+1+Tặng+1')">
                            <div class="card-body d-flex flex-column justify-content-end p-4">
                                <h3 class="card-title fw-bold">MUA 1 TẶNG 1</h3>
                                <p class="card-text">Khi mua sản phẩm Quần Jeans bất kỳ.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 shadow-sm border-0 rounded-3 promo-card" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6)), url('https://via.placeholder.com/400x250/198754/white?text=Freeship')">
                            <div class="card-body d-flex flex-column justify-content-end p-4">
                                <h3 class="card-title fw-bold">MIỄN PHÍ VẬN CHUYỂN</h3>
                                <p class="card-text">Cho đơn hàng từ 500.000 VNĐ.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <main class="container mt-5">

        <section class="mb-5">
            <h2 class="text-center mb-4 fw-bold">Khám Phá Danh Mục</h2>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center">
                @forelse($categories as $category)
                    <div class="col">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-0 category-card text-center">
                                <div class="card-body p-4">
                                    <i class="bi bi-tag fs-1 text-primary"></i>
                                    <h5 class="card-title mt-3 mb-0">{{ $category->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Chưa có danh mục nào.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="mb-5">
            <h2 class="text-center mb-4 fw-bold">Sản Phẩm Mới Nhất</h2>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse($featuredProducts as $product)
                    <div class="col">
                        
                        {{-- PHẦN THAY ĐỔI NẰM Ở ĐÂY Ạ --}}
                        <div class="card h-100 shadow-sm border-0 product-card">
                            
                            <img src="{{ ($product->image ? asset('images/' . $product->image) : ($product->image_url ? asset('images/' . $product->image_url) : 'https://via.placeholder.com/300x300/e9ecef/6c757d?text=No+Image')) }}" class="card-img-top" alt="{{ $product->name }}">
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark stretched-link">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small">{{ $product->category->name ?? 'Chưa phân loại' }}</p>
                                <p class="card-text fs-5 fw-bold text-danger mt-auto">
                                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 p-3">
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type"submit" class="btn btn-outline-primary w-100">
                                        <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ
                                    </button>
                                </form>
                            </div>
                        </div>
                        {{-- KẾT THÚC PHẦN THAY ĐỔI --}}

                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Chưa có sản phẩm nào để hiển thị.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-lg">Xem Tất Cả Sản Phẩm</a>
            </div>
        </section>

        <section class="mb-5 py-5 bg-white shadow-sm rounded">
            <div class="container">
                <h2 class="text-center mb-4 fw-bold">Vì Sao Chọn Cỏ Sài Gòn?</h2>
                <div class="row text-center g-4">
                    <div class="col-md-4">
                        <i class="bi bi-gem feature-icon mb-3"></i>
                        <h4 class="fw-semibold">Chất Lượng Hàng Đầu</h4>
                        <p class="text-muted">Mỗi sản phẩm đều được tuyển chọn kỹ lưỡng từ chất liệu vải cao cấp, đảm bảo độ bền và sự thoải mái.</p>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-palette-fill feature-icon mb-3"></i>
                        <h4 class="fw-semibold">Thiết Kế Độc Quyền</h4>
                        <p class="text-muted">Luôn cập nhật xu hướng mới nhất, mang đến những thiết kế tinh tế, hiện đại và mang đậm dấu ấn riêng.</p>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-heart-fill feature-icon mb-3"></i>
                        <h4 class="fw-semibold">Dịch Vụ Tận Tâm</h4>
                        <p class="text-muted">Đội ngũ Cỏ Sài Gòn luôn sẵn sàng tư vấn và hỗ trợ bạn 24/7, mang đến trải nghiệm mua sắm tuyệt vời.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 p-4 shadow-sm border-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <i class="bi bi-truck display-4 text-primary"></i>
                            </div>
                            <div class="col">
                                <h4 class="fw-semibold mb-1">Giao Hàng Siêu Tốc</h4>
                                <p class="mb-0 text-muted">Miễn phí vận chuyển toàn quốc cho đơn hàng từ 500k. Giao hàng hỏa tốc 2h tại TP.HCM.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4 shadow-sm border-0">
                         <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <i class="bi bi-shield-check display-4 text-success"></i>
                            </div>
                            <div class="col">
                                <h4 class="fw-semibold mb-1">Chính Sách Bảo Hành</h4>
                                <p class="mb-0 text-muted">Đổi trả miễn phí trong 30 ngày nếu có lỗi từ nhà sản xuất hoặc không vừa size. Bảo hành đường may 6 tháng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>