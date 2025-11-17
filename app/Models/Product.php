<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Đảm bảo $fillable có 'image_url'
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'stock', 
        'category_id', 
        'image_url',
        'image',
    ];

    /**
     * Lấy danh mục của sản phẩm.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Lấy tất cả các đánh giá (reviews) của sản phẩm này.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Hàm tiện ích: Tính số sao trung bình
     */
    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating'), 1);
    }
}