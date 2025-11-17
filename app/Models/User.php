<?php

namespace App\Models;

// BỎ DÒNG NÀY: use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

// BỎ "implements MustVerifyEmail" Ở DÒNG DƯỚI
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // If you want Laravel to automatically hash passwords when set on the model,
        // use the 'hashed' cast. Note: this requires Laravel's hashed cast support.
        'password' => 'hashed',
    ];
    
    /**
     * Lấy các đơn hàng của người dùng.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Lấy tất cả các đánh giá (reviews) của người dùng này.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Lấy tất cả các bài post (blog) của người dùng này.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}