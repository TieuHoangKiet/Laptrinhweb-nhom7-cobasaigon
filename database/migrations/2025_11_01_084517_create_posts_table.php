<?php

// SỬA LỖI Ở DÒNG NÀY:
use Illuminate\Database\Migrations\Migration; // (Đã thêm dấu \ bị thiếu)
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ai là tác giả
            $table->string('title'); // Tiêu đề bài viết
            $table->text('content'); // Nội dung bài viết
            $table->timestamps(); // Ngày tạo, ngày cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};