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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // --- PHẦN CẢI TIẾN ---
            // Thêm các cột thông tin người nhận hàng
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->text('notes')->nullable(); // Ghi chú (có thể trống)
            
            // Thêm cột tổng tiền
            $table->decimal('total_price', 15, 2); // Dùng decimal cho tiền là chuẩn nhất
            
            // Cột status (Lấy từ file migration 2025_11_01_041516)
            $table->string('status')->default('pending'); 
            // --- KẾT THÚC CẢI TIẾN ---
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};