<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Liên kết với đơn hàng
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Liên kết với sản phẩm
            $table->integer('quantity'); // Số lượng mua
            $table->decimal('price', 8, 2); // Giá tại thời điểm mua
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};