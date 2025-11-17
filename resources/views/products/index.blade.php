<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Sản Phẩm - Cỏ Sài Gòn</title>

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
        .card {
            position: relative; /* Dành cho stretched-link */
        }
        /* Tùy chỉnh cho link danh mục đang active */
        .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>

    <x-header />

    <main class="py-5">
        <div class="container">

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
                </ol>
            </nav>

            <div class="row g-4">
                
                <aside class="col-lg-3">
                    <!-- Danh Mục Sản Phẩm -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-bold">Danh Mục Sản Phẩm</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('products.index') }}" 
                               class="list-group-item list-group-item-action {{ !$currentCategory ? 'active' : '' }}">
                                Tất Cả Sản Phẩm
                            </a>
                            
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category_id' => $category->id]) }}" 
                                   class="list-group-item list-group-item-action {{ $currentCategory && $currentCategory->id == $category->id ? 'active' : '' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Phân Loại Giá -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-bold">Phân Loại Giá</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('products.index') }}" id="priceFilterForm">
                                @if($currentCategory)
                                    <input type="hidden" name="category_id" value="{{ $currentCategory->id }}">
                                @endif
                                
                                <div class="mb-3">
                                    <label for="minPrice" class="form-label text-muted small">Giá từ</label>
                                    <input type="number" id="minPrice" name="min_price" class="form-control" 
                                           value="{{ $minPrice }}" step="10000" min="0">
                                </div>

                                <div class="mb-3">
                                    <label for="maxPrice" class="form-label text-muted small">Giá đến</label>
                                    <input type="number" id="maxPrice" name="max_price" class="form-control" 
                                           value="{{ $maxPrice }}" step="10000" min="0">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-funnel me-2"></i>Lọc Giá
                                    </button>
                                </div>

                                @if($minPrice > 0 || $maxPrice < 10000000)
                                    <div class="mt-2">
                                        <a href="{{ route('products.index', $currentCategory ? ['category_id' => $currentCategory->id] : []) }}" 
                                           class="btn btn-outline-secondary btn-sm w-100">
                                            <i class="bi bi-x-circle me-2"></i>Xóa Bộ Lọc
                                        </a>
                                    </div>
                                @endif
                            </form>

                            <!-- Hiển thị các khoảng giá nhanh -->
                            <hr>
                            <div class="d-flex flex-column gap-2">
                                <a href="{{ route('products.index', array_merge($currentCategory ? ['category_id' => $currentCategory->id] : [], ['min_price' => 0, 'max_price' => 200000])) }}" 
                                   class="btn btn-outline-secondary btn-sm">
                                    Dưới 200K
                                </a>
                                <a href="{{ route('products.index', array_merge($currentCategory ? ['category_id' => $currentCategory->id] : [], ['min_price' => 200000, 'max_price' => 500000])) }}" 
                                   class="btn btn-outline-secondary btn-sm">
                                    200K - 500K
                                </a>
                                <a href="{{ route('products.index', array_merge($currentCategory ? ['category_id' => $currentCategory->id] : [], ['min_price' => 500000, 'max_price' => 1000000])) }}" 
                                   class="btn btn-outline-secondary btn-sm">
                                    500K - 1M
                                </a>
                                <a href="{{ route('products.index', array_merge($currentCategory ? ['category_id' => $currentCategory->id] : [], ['min_price' => 1000000, 'max_price' => 10000000])) }}" 
                                   class="btn btn-outline-secondary btn-sm">
                                    Trên 1M
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

                <section class="col-lg-9">
                    <h2 class="mb-4 fw-bold">
                        {{ $currentCategory ? $currentCategory->name : 'Tất Cả Sản Phẩm' }}
                    </h2>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @forelse ($products as $product)
                            <div class="col">
                                {{-- Dùng lại code product-card từ trang chủ --}}
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
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    Không tìm thấy sản phẩm nào phù hợp.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        {{-- 
                            Link phân trang này sẽ tự động giữ lại tham số ?category_id=... 
                            nhờ chúng ta đã sửa Controller
                        --}}
                        {{ $products->links() }}
                    </div>

                </section>
            </div>
        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>