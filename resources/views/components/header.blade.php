@php
    use Illuminate\Support\Facades\Storage;
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <x-application-logo style="height: 40px;" /> 
            <span class="ms-2 fs-5 fw-bold">Cỏ Sài Gòn</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door-fill me-1"></i> Trang Chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        <i class="bi bi-tshirt-fill me-1"></i> Sản Phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">
                        <i class="bi bi-pencil-square me-1"></i> Blog
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}" title="Giỏ hàng">
                        <i class="bi bi-cart-fill fs-5"></i>
                        <span class="badge rounded-pill bg-danger" id="cart-count">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Đăng Nhập
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white ms-lg-2" href="{{ route('register') }}">
                                <i class="bi bi-person-plus-fill me-1"></i> Đăng Ký
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="rounded-circle me-2" 
                                     style="width: 32px; height: 32px; object-fit: cover;">
                            @else
                                <i class="bi bi-person-circle fs-4 me-2"></i>
                            @endif
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.orders.index') }}">
                                        <i class="bi bi-shield-lock-fill me-2"></i> Trang Admin
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Bảng điều khiển
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-circle me-2"></i> Hồ sơ
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-box-seam-fill me-2"></i> Đơn hàng của tôi
                                </a>
                            </li>
                            
                            {{-- ===== THÊM DÒNG NÀY ===== --}}
                            <li>
                                <a class="dropdown-item" href="{{ route('blog.create') }}">
                                    <i class="bi bi-pencil-fill me-2"></i> Viết bài Blog
                                </a>
                            </li>
                            {{-- ======================== --}}
                            
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Đăng Xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>