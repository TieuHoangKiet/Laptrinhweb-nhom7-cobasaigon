<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại tới bảng users (ai là người đánh giá)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Khóa ngoại tới bảng products (đánh giá cho sản phẩm nào)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // Cột để lưu số sao (từ 1 đến 5)
            $table->tinyInteger('rating'); // Dùng tinyInteger (1-5) cho tiết kiệm
            $table->text('comment')->nullable(); // Nội dung bình luận (có thể trống)
            $table->timestamps(); // (created_at)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};