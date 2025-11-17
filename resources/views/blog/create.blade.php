<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Viết Bài Mới - Cỏ Sài Gòn</title>

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
            <div class="col-lg-8">
                <h1 class="text-center mb-4 fw-bold">Viết Bài Blog Mới</h1>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        
                        {{-- ===== SỬA 1: THÊM enctype="multipart/form-data" VÀO FORM ===== --}}
                        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h5 class="alert-heading">Ối, có lỗi rồi!</h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="title" class="form-label fs-5 fw-semibold">Tiêu đề bài viết</label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}" 
                                       placeholder="5 xu hướng thời trang..."
                                       required>
                            </div>

                            {{-- ===== SỬA 2: THÊM TRƯỜNG TẢI ẢNH ===== --}}
                            <div class="mb-3">
                                <label for="image_url" class="form-label fs-5 fw-semibold">Ảnh bìa (Tùy chọn)</label>
                                <input type="file" 
                                       class="form-control @error('image_url') is-invalid @enderror" 
                                       id="image_url" 
                                       name="image_url">
                            </div>
                            {{-- ====================================== --}}

                            <div class="mb-3">
                                <label for="content" class="form-label fs-5 fw-semibold">Nội dung</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" 
                                          name="content" 
                                          rows="10" 
                                          placeholder="Viết câu chuyện của bạn ở đây..."
                                          required>{{ old('content') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('blog.index') }}" class="btn btn-secondary">Hủy bỏ</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send-fill me-2"></i> Đăng bài
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>