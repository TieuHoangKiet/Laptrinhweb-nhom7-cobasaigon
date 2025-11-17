<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * Các thuộc tính được phép gán hàng loạt.
     */
    protected $fillable = [
        'user_id',
        'title',
        'image_url', // <-- THÊM DÒNG NÀY
        'content',
    ];

    /**
     * Lấy người dùng (user) là tác giả của bài post này.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}