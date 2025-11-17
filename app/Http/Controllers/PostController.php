<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Hiển thị trang blog chính (danh sách các bài post).
     */
    public function index()
    {
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
     * Lưu bài post mới vào database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Bạn ơi, tiêu đề không được để trống nhé.',
            'content.required' => 'Bạn ơi, nội dung không được để trống.',
            'content.min' => 'Bài viết cần có nội dung dài ít nhất 50 ký tự.',
            'image_url.image' => 'File bạn tải lên phải là hình ảnh (jpg, png...).',
            'image_url.max' => 'Ảnh không nặng quá 2MB.',
        ]);

        $imageUrl = null;

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('blog_images', 'public');
            $imageUrl = $path;
        }

        $dataToSave = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image_url' => $imageUrl,
        ];

        Auth::user()->posts()->create($dataToSave);

        return redirect()->route('blog.index')->with('success', 'Bạn đã đăng bài thành công!');
    }
}
