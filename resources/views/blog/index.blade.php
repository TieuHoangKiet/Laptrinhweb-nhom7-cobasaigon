<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - Cỏ Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f8f9fa; }
        /* Thêm style cho ảnh blog */
        .blog-post-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 0.375rem 0.375rem 0 0; /* Bo góc trên */
        }
    </style>
</head>
<body>

    <x-header />

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="fw-bold mb-0">Blog Cỏ Sài Gòn</h1>
                        <p class="text-muted mb-0">Chia sẻ từ cộng đồng</p>
                    </div>
                    @auth
                        <a href="{{ route('blog.create') }}" class="btn btn-primary">
                            <i class="bi bi-pencil-square me-2"></i> Viết bài mới
                        </a>
                    @endauth
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @forelse ($posts as $post)
                    <div class="card shadow-sm border-0 mb-4">
                        
                        {{-- ===== SỬA: HIỂN THỊ ẢNH NẾU CÓ ===== --}}
                        @if ($post->image_url)
                            <img src="{{ Storage::url($post->image_url) }}" class="blog-post-image" alt="{{ $post->title }}">
                        @else
                            {{-- Ảnh placeholder nếu không có ảnh --}}
                            <img src="https://via.placeholder.com/800x300/6c757d/white?text=Cỏ+Sài+Gòn" class="blog-post-image" alt="Ảnh mặc định">
                        @endif
                        {{-- ===================================== --}}

                        <div class="card-body p-4">
                            <h4 class="card-title fw-semibold">{{ $post->title }}</h4>
                            
                            <p class="card-text text-muted small mb-2">
                                <i class="bi bi-person-circle me-1"></i>
                                Đăng bởi: <strong class="text-dark">{{ $post->user->name ?? 'Người dùng đã xóa' }}</strong>
                                - <i class="bi bi-clock me-1"></i> {{ $post->created_at->format('d/m/Y') }}
                            </p>
                            
                            <p class="card-text">
                                {{ Str::limit($post->content, 200) }}
                            </p>
                            
                            <button class="btn btn-outline-primary btn-sm" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#blogCollapse-{{ $post->id }}" 
                                    aria-expanded="false" 
                                    aria-controls="blogCollapse-{{ $post->id }}">
                                Đọc thêm <i class="bi bi-arrow-down-short"></i>
                            </button>
                            
                            <div class="collapse mt-3" id="blogCollapse-{{ $post->id }}">
                                <hr>
                                <p>{!! nl2br(e($post->content)) !!}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted fs-4">Chưa có bài blog nào.</p>
                        @auth
                            <p>Hãy là người đầu tiên viết bài!</p>
                        @else
                            <p><a href="{{ route('login') }}">Đăng nhập</a> để bắt đầu viết bài.</p>
                        @endauth
                    </div>
                @endforelse

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
                
            </div>
        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>