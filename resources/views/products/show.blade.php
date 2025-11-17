<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ $product->name }} - Cỏ Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f8f9fa; }
        .product-detail-img { max-height: 500px; width: 100%; object-fit: cover; border-radius: 0.5rem; }
        .product-card img { height: 300px; object-fit: cover; }
        .card { position: relative; }
        .form-quantity { width: 100px; }

        /* ===== CSS CHO ĐÁNH GIÁ SAO (DÙNG BOOTSTRAP ICONS) ===== */
        .star-rating {
            font-size: 1.5rem;
            color: #ffc107; /* Màu vàng của sao */
        }
        .star-rating .bi-star {
            color: #e4e5e9; /* Màu sao rỗng */
        }
        
        /* CSS cho form đánh giá (sao có thể bấm) */
        .rating-form-stars {
            display: inline-flex;
            flex-direction: row-reverse; /* Đảo ngược để khi hover sao sáng đúng */
            justify-content: flex-end;
        }
        .rating-form-stars input[type="radio"] {
            display: none; /* Ẩn radio button */
        }
        .rating-form-stars label {
            font-size: 2rem;
            color: #e4e5e9;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0 0.1em;
        }
        /* Khi hover vào 1 sao, tất cả sao bên trái nó (do đã reverse) sẽ sáng */
        .rating-form-stars:hover label {
            color: #ffc107;
        }
        .rating-form-stars label:hover ~ label {
            color: #ffc107;
        }
        /* Khi radio được check, sao sẽ sáng */
        .rating-form-stars input[type="radio"]:checked ~ label {
            color: #ffc107;
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
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản Phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <img src="{{ ($product->image ? asset('images/' . $product->image) : ($product->image_url ? asset('images/' . $product->image_url) : 'https://via.placeholder.com/600x600')) }}" alt="{{ $product->name }}" class="product-detail-img shadow-sm">
                        </div>

                        <div class="col-lg-6">
                            <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>
                            
                            <div class="d-flex align-items-center mb-3">
                                @if($totalReviews > 0)
                                    <div class="star-rating me-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $averageRating)
                                                <i class="bi bi-star-fill"></i> @elseif ($i - 0.5 <= $averageRating)
                                                <i class="bi bi-star-half"></i> @else
                                                <i class="bi bi-star"></i> @endif
                                        @endfor
                                    </div>
                                    <span class="text-muted">({{ $averageRating }} sao / {{ $totalReviews }} đánh giá)</span>
                                @else
                                    <span class="text-muted">Chưa có đánh giá</span>
                                @endif
                            </div>
                            <div class="fs-5 mb-3">
                                <span class="fw-bold text-danger fs-3">
                                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                                </span>
                            </div>

                            <p class="text-muted mb-3">Danh mục: 
                                <a href="#" class="text-decoration-none">{{ $product->category->name ?? 'Chưa phân loại' }}</a>
                            </p>
                            
                            <p class="lead mb-4">{{ $product->description }}</p>

                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <div class="d-flex align-items-center mb-4">
                                    <label for="quantity" class="form-label me-3 mb-0 fw-semibold">Số lượng:</label>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control text-center form-quantity">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                                    <i class="bi bi-cart-plus-fill me-2"></i> Thêm vào giỏ hàng
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Mô Tả Chi Tiết</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        {{-- Hiển thị tổng số review --}}
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                            Đánh Giá ({{ $totalReviews }})
                        </button>
                    </li>
                </ul>
                <div class="tab-content bg-white p-4 border border-top-0 rounded-bottom" id="productTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <h5 class="fw-semibold">Mô tả sản phẩm</h5>
                        <p>{{ $product->description }}</p>
                    </div>
                    
                    {{-- ===== PHẦN HIỂN THỊ ĐÁNH GIÁ ===== --}}
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="row">
                            <div class="col-md-7">
                                <h5 class="fw-semibold mb-4">Tất cả đánh giá ({{ $totalReviews }})</h5>
                                @forelse($reviews as $review)
                                    <div class="d-flex mb-4">
                                        <img src="{{ $review->user->avatar ? Storage::url($review->user->avatar) : 'https://via.placeholder.com/50' }}" 
                                             alt="{{ $review->user->name }}"
                                             class="rounded-circle me-3" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <h6 class="fw-semibold mb-0">{{ $review->user->name }}</h6>
                                            <div class="star-rating mb-1" style="font-size: 1rem;">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                @endfor
                                            </div>
                                            <p class="text-muted mb-1"><small>{{ $review->created_at->format('d/m/Y \l\ú\c H:i') }}</small></p>
                                            <p class="mb-0">{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>
                                @endforelse
                                
                                <div class="mt-4 d-flex justify-content-center">
                                    {{ $reviews->links() }}
                                </div>
                            </div>
                            
                            <div class="col-md-5">
                                <h5 class="fw-semibold mb-4">Gửi đánh giá của bạn</h5>
                                @auth
                                    <form action="{{ route('reviews.store', $product) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Bạn đánh giá mấy sao?</label>
                                            <div class="rating-form-stars">
                                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 sao"><i class="bi bi-star-fill"></i></label>
                                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 sao"><i class="bi bi-star-fill"></i></label>
                                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 sao"><i class="bi bi-star-fill"></i></label>
                                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 sao"><i class="bi bi-star-fill"></i></label>
                                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 sao"><i class="bi bi-star-fill"></i></label>
                                            </div>
                                            @error('rating') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="comment" class="form-label fw-semibold">Viết bình luận của bạn (tùy chọn)</label>
                                            <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Sản phẩm này rất tốt...">{{ old('comment') }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Gửi đánh giá</button>
                                    </form>
                                @else
                                    <div class="alert alert-info">
                                        Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để để lại đánh giá.
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">Sản Phẩm Liên Quan</h2>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse($relatedProducts as $relatedProduct)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 product-card">
                            <img src="{{ ($relatedProduct->image ? asset('images/' . $relatedProduct->image) : ($relatedProduct->image_url ? asset('images/' . $relatedProduct->image_url) : 'https://via.placeholder.com/300x300')) }}" class="card-img-top" alt="{{ $relatedProduct->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <a href="{{ route('products.show', $relatedProduct) }}" class="text-decoration-none text-dark stretched-link">
                                        {{ $relatedProduct->name }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small">{{ $relatedProduct->category->name ?? 'Chưa phân loại' }}</p>
                                <p class="card-text fs-5 fw-bold text-danger mt-auto">
                                    {{ number_format($relatedProduct->price, 0, ',', '.') }} VNĐ
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 p-3">
                                <form action="{{ route('cart.add', $relatedProduct) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary w-100">
                                        <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Không tìm thấy sản phẩm liên quan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>