<?php

namespace App\Http\Controllers;

use App\Models\Product; // Phải import model Product
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ với các sản phẩm động.
     */
    public function index()
    {
        // Lấy 8 sản phẩm mới nhất
        $newProducts = Product::latest()->take(8)->get();

        // Lấy 4 sản phẩm nổi bật (tạm thời lấy ngẫu nhiên)
        // Sau này mình có thể thêm cột 'is_featured' vào database
        $featuredProducts = Product::inRandomOrder()->take(4)->get();

        // Trả về view 'welcome' và truyền 2 biến 'newProducts' và 'featuredProducts'
        return view('welcome', [
            'newProducts' => $newProducts,
            'featuredProducts' => $featuredProducts
        ]);
    }
}