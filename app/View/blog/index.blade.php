<!-- resources/views/blog/index.blade.php -->
@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Blog (Chức năng đang phát triển)</h1>
    <p class="text-gray-600">Nội dung blog sẽ được cập nhật sớm.</p>
    <!-- Hoặc bạn có thể hiển thị một số bài viết giả -->
    <div class="mt-6">
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <h3 class="font-semibold text-lg">Bài viết 1</h3>
            <p class="text-gray-600">Nội dung bài viết 1...</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <h3 class="font-semibold text-lg">Bài viết 2</h3>
            <p class="text-gray-600">Nội dung bài viết 2...</p>
        </div>
    </div>
</div>
@endsection