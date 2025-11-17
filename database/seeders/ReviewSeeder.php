<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review; // Thêm
use App\Models\Product; // Thêm
use App\Models\User; // Thêm

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ (nếu có)
        Review::truncate();

        // Lấy tất cả user và product
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->info('Không thể tạo review vì không có user hoặc product.');
            return;
        }

        $comments = [
            'Vải đẹp, mặc mát, sẽ ủng hộ shop tiếp!',
            'Sản phẩm tuyệt vời, chất lượng 5 sao.',
            'Giao hàng hơi chậm nhưng đồ đẹp nên vẫn cho 5 sao.',
            'Form áo rất chuẩn, mình rất ưng ý.',
            'Màu sắc hơi khác so với ảnh một chút, nhưng vẫn đẹp.',
            'Giá hơi cao so với chất lượng, tạm ổn.',
            'Rất đáng tiền, nên mua nha mọi người.',
            'Shop tư vấn nhiệt tình, giao hàng nhanh.',
        ];

        // Tạo 20 đánh giá giả
        for ($i = 0; $i < 20; $i++) {
            Review::create([
                'user_id' => $users->random()->id, // Chọn 1 user ngẫu nhiên
                'product_id' => $products->random()->id, // Chọn 1 sản phẩm ngẫu nhiên
                'rating' => rand(3, 5), // Random số sao từ 3-5
                'comment' => $comments[array_rand($comments)], // Chọn 1 bình luận ngẫu nhiên
                'created_at' => now()->subDays(rand(1, 30)), // Giả ngày đăng
            ]);
        }
    }
}