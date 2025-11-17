<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- THÊM DÒNG NÀY

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    /**
     * Lấy người dùng (user) đã viết đánh giá này.
     */
    // Thêm kiểu trả về BelongsTo
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy sản phẩm (product) mà đánh giá này thuộc về.
     */
    // Thêm kiểu trả về BelongsTo
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}