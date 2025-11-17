<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // <-- THÊM DÒNG NÀY

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive(); // <-- THÊM DÒNG NÀY ĐỂ PHÂN TRANG DÙNG BOOTSTRAP 5
    }
}