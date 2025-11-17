<?php

namespace App\Http\Controllers; // <-- ĐÂY LÀ DÒNG ĐÃ SỬA (dùng dấu \ )

use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ... (Hàm home, userIndex, userShow giữ nguyên như cũ)
    public function home()
    {
        $featuredProducts = Product::latest()->take(8)->get();
        $categories = Category::all();
        return view('welcome', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories
        ]);
    }

    public function userIndex(Request $request)
    {
        $categories = Category::all();
        $selectedCategoryId = $request->input('category_id');
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 10000000);
        
        $productQuery = Product::query();
        $currentCategory = null; 

        if ($selectedCategoryId) {
            $productQuery->where('category_id', $selectedCategoryId);
            $currentCategory = Category::find($selectedCategoryId);
        }

        // Thêm filter giá
        $productQuery->whereBetween('price', [$minPrice, $maxPrice]);
        
        $products = $productQuery->latest()->paginate(12);

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $currentCategory,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }

    public function userShow(Product $product)
    {
        // Tải sản phẩm liên quan
        $relatedProducts = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $product->id)
                                    ->latest()
                                    ->take(4)
                                    ->get();

        // Tải reviews và tính toán
        $reviews = $product->reviews()->with('user')->latest()->paginate(5);
        $averageRating = $product->averageRating();
        $totalReviews = $product->reviews()->count(); 

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'reviews' => $reviews, 
            'averageRating' => $averageRating, 
            'totalReviews' => $totalReviews, 
        ]);
    }

    // ===== PHẦN ADMIN =====

    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url|max:255',
            'stock' => 'required|integer|min:0',
        ]);
        Product::create($request->all());
        return redirect()->route('admin.products.index')
                         ->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url|max:255',
            'stock' => 'required|integer|min:0',
        ]);
        $product->update($request->all());
        return redirect()->route('admin.products.index')
                         ->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
                         ->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}