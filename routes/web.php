<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController; 
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route cho trang chủ
Route::get('/', [ProductController::class, 'home'])->name('home');

// Route cho danh sách sản phẩm người dùng
Route::get('/products', [ProductController::class, 'userIndex'])->name('products.index');

// Route cho trang Blog (đã sửa)
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');


// Route Dashboard (đã sửa, bỏ 'verified')
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.orders.index');
    }
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // ===== SỬA LỖI Ở ĐÂY (R hoa) =====
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // ===================================
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route cho giỏ hàng
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::put('/update/{productId}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{productId}', [CartController::class, 'remove'])->name('remove');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/checkout', [CartController::class, 'processCheckout'])->name('processCheckout');
        Route::get('/checkout/success/{order}', [CartController::class, 'success'])->name('success');
    });

    // Route cho lịch sử đơn hàng của người dùng
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('orders.show'); 

    // Route để gửi đánh giá
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    
    // Route Blog (cho người đã đăng nhập)
    Route::get('/blog/create', [PostController::class, 'create'])->name('blog.create');
    Route::post('/blog', [PostController::class, 'store'])->name('blog.store');
});

// Route cho chi tiết sản phẩm người dùng
Route::get('/products/{product}', [ProductController::class, 'userShow'])->name('products.show');

// Nhóm route admin
Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class)->names('products');
    Route::resource('orders', OrderController::class)->names('orders');
    Route::resource('categories', CategoryController::class)->names('categories');
});

// File auth.php này (theo cấu trúc L10) sẽ được load
require __DIR__.'/auth.php';