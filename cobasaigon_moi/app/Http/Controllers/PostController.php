<?php

namespace App\Http\Controllers; // <-- ĐÃ SỬA LẠI DÒNG BỊ LỖI

// Thêm các use bị thiếu
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Thêm class bị thiếu
class PostController extends Controller
{
    /**
     * Hiển thị trang blog chính (danh sách các bài post).
     */
    public function index()
    {
        // Lấy tất cả bài post, mới nhất lên trên, và tải kèm thông tin 'user'
        $posts = Post::with('user')->latest()->paginate(10);
        
        return view('blog.index', compact('posts'));
    }

    /**
     * Hiển thị form để tạo bài post mới.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Lưu bài post mới vào database (ĐÃ NÂNG CẤP).
     */
    public function store(Request $request)
    {
        // 1. Xác thực dữ liệu (thêm validate cho ảnh)
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Cho phép ảnh tối đa 2MB
        ], [
            'title.required' => 'Bạn ơi, tiêu đề không được để trống nhé.',
            'content.required' => 'Bạn ơi, nội dung không được để trống.',
            'content.min' => 'Bài viết cần có nội dung dài ít nhất 50 ký tự.',
            'image_url.image' => 'File bạn tải lên phải là hình ảnh (jpg, png...).',
            'image_url.max' => 'Ảnh không nặng quá 2MB.',
        ]);

        $imageUrl = null; // Biến tạm để lưu đường dẫn ảnh

        // 2. Xử lý tải ảnh (nếu có)
        if ($request->hasFile('image_url')) {
            // Lưu ảnh vào thư mục 'storage/app/public/blog_images'
            $path = $request->file('image_url')->store('blog_images', 'public');
            $imageUrl = $path; // Lấy đường dẫn đã lưu
        }

        // 3. Chuẩn bị dữ liệu để lưu
        $dataToSave = [
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imageUrl, // Thêm đường dẫn ảnh (có thể là null)
        ];

        // 4. Tạo bài post
        Auth::user()->posts()->create($dataToSave);

        // 5. Chuyển hướng về trang blog chính
        return redirect()->route('blog.index')->with('success', 'Bạn đã đăng bài thành công!');
    }
} // <-- Thêm dấu } bị thiếu