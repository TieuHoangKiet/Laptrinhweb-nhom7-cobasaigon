<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - Cỏ Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            z-index: 1000;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .sidebar-sticky { padding-top: .5rem; }
        .main-content { margin-left: 250px; }
        .navbar-brand { padding-top: .75rem; padding-bottom: .75rem; }
    </style>
</head>
<body>
    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ route('admin.orders.index') }}">
            Cỏ Sài Gòn - Admin
        </a>
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap d-flex align-items-center">
                <span class="nav-link px-3 text-white">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link px-3 bg-dark border-0">Đăng Xuất</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
                <div class="position-sticky sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            {{-- Sửa: Trỏ link "Bảng điều khiển" về trang chủ (home) theo yêu cầu --}}
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-speedometer2 me-2"></i> Bảng điều khiển
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                                <i class="bi bi-box-seam-fill me-2"></i> Quản lý Đơn Hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                                <i class="bi bi-tshirt-fill me-2"></i> Quản lý Sản Phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                <i class="bi bi-tags-fill me-2"></i> Quản lý Danh Mục
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    {{-- Tiêu đề (Slot) --}}
                    {{ $header ?? '' }}
                </div>
                
                {{-- Nội dung chính (Slot) --}}
                {{ $slot }}

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>