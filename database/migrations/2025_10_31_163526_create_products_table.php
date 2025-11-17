<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            
            // Khóa ngoại
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            // ===== SỬA LỖI Ở ĐÂY =====
            $table->string('image_url')->nullable(); // Sửa từ 'image' thành 'image_url'
            // =========================
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};