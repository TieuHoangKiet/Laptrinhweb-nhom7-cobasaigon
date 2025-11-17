{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-center text-md-start">
        <div class="row">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4">
                    Cỏ Sài Gòn
                </h6>
                <p>
                    Mang đến phong cách thời trang độc đáo, hiện đại và tinh tế cho bạn.
                </p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4">
                    Sản phẩm
                </h6>
                <p><a href="{{ route('products.index') }}" class="text-reset text-decoration-none">Áo</a></p>
                <p><a href="{{ route('products.index') }}" class="text-reset text-decoration-none">Quần</a></p>
                <p><a href="{{ route('products.index') }}" class="text-reset text-decoration-none">Váy</a></p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4">
                    Liên kết
                </h6>
                @auth
                    <p><a href="{{ route('profile.edit') }}" class="text-reset text-decoration-none">Tài khoản</a></p>
                    <p><a href="{{ route('orders.index') }}" class="text-reset text-decoration-none">Đơn hàng</a></p>
                @else
                    <p><a href="{{ route('login') }}" class="text-reset text-decoration-none">Đăng nhập</a></p>
                    <p><a href="{{ route('register') }}" class="text-reset text-decoration-none">Đăng ký</a></p>
                @endauth
                <p><a href="#!" class="text-reset text-decoration-none">Trợ giúp</a></p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold mb-4">Liên hệ</h6>
                <p><i class="bi bi-geo-alt-fill me-3"></i> 123 Đường ABC, Q.1, TP. HCM</p>
                <p><i class="bi bi-envelope-fill me-3"></i> info@cosaigon.com</p>
                <p><i class="bi bi-phone-fill me-3"></i> +84 123 456 789</p>
            </div>
        </div>
    </div>
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        &copy; {{ date('Y') }} Cỏ Sài Gòn.
        <div class="mt-2">
            <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
            <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-4"></i></a>
            <a href="#" class="text-white"><i class="bi bi-tiktok fs-4"></i></a>
        </div>
    </div>
</footer>