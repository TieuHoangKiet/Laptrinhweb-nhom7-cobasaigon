<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pantsId = Category::where('name', 'Pants')->first()->id;
        $shirtsId = Category::where('name', 'Shirts')->first()->id;
        $shoesId = Category::where('name', 'Shoes')->first()->id;
        $hatsId = Category::where('name', 'Hats')->first()->id;
        $bagsId = Category::where('name', 'Bags')->first()->id;

        $products = [
            // Pants (10 sản phẩm)
                ['name' => 'Slim Fit Jeans', 'description' => 'Jeans dáng slim fit, chất liệu cotton co giãn.', 'price' => 650000, 'stock' => 25, 'category_id' => $pantsId, 'image' => 'quan-1.jpg'],
            ['name' => 'Cargo Pants', 'description' => 'Quần cargo nhiều túi, phong cách unisex.', 'price' => 550000, 'stock' => 30, 'category_id' => $pantsId, 'image' => 'quan-2.png'],
            ['name' => 'Chino Pants', 'description' => 'Quần chino lịch sự, phù hợp công sở.', 'price' => 480000, 'stock' => 20, 'category_id' => $pantsId, 'image' => 'quan-3.jpg'],
            ['name' => 'Short Pants', 'description' => 'Quần short kaki, thoáng mát cho mùa hè.', 'price' => 320000, 'stock' => 40, 'category_id' => $pantsId, 'image' => 'quan-4.jpg'],
            ['name' => 'Jogger Pants', 'description' => 'Quần jogger thể thao, thoải mái.', 'price' => 400000, 'stock' => 35, 'category_id' => $pantsId, 'image' => 'quan-5.jpg'],
            ['name' => 'Denim Pants', 'description' => 'Quần denim xanh cổ điển.', 'price' => 580000, 'stock' => 18, 'category_id' => $pantsId, 'image' => 'quan-6.jpg'],
            ['name' => 'Twill Pants', 'description' => 'Quần vải twill bền chắc.', 'price' => 520000, 'stock' => 22, 'category_id' => $pantsId, 'image' => 'quan-7.jpg'],
            ['name' => 'Linen Pants', 'description' => 'Quần linen thoáng mát, mùa hè.', 'price' => 600000, 'stock' => 15, 'category_id' => $pantsId, 'image' => 'quan-8.jpg'],
            ['name' => 'Corduroy Pants', 'description' => 'Quần nhung gân, phong cách retro.', 'price' => 560000, 'stock' => 12, 'category_id' => $pantsId, 'image' => 'quan-9.jpg'],
            ['name' => 'Tapered Pants', 'description' => 'Quần dáng suôn hẹp dần về gấu.', 'price' => 620000, 'stock' => 28, 'category_id' => $pantsId, 'image' => 'quan-10.jpg'],

            // Shirts (10 sản phẩm)
                ['name' => 'Basic T-Shirt White', 'description' => 'Áo thun basic màu trắng.', 'price' => 180000, 'stock' => 50, 'category_id' => $shirtsId, 'image' => 'ao-1.jpg'],
            ['name' => 'Polo Shirt Navy', 'description' => 'Áo polo cổ bẻ màu xanh navy.', 'price' => 320000, 'stock' => 30, 'category_id' => $shirtsId, 'image' => 'ao-2.jpg'],
            ['name' => 'Oxford Shirt Blue', 'description' => 'Áo sơ mi oxford màu xanh.', 'price' => 450000, 'stock' => 25, 'category_id' => $shirtsId, 'image' => 'ao-3.jpg'],
            ['name' => 'Long Sleeve Tee Black', 'description' => 'Áo thun dài tay màu đen.', 'price' => 220000, 'stock' => 40, 'category_id' => $shirtsId, 'image' => 'ao-4.jpg'],
            ['name' => 'Flannel Shirt Red', 'description' => 'Áo flannel caro đỏ.', 'price' => 380000, 'stock' => 20, 'category_id' => $shirtsId, 'image' => 'ao-5.jpg'],
            ['name' => 'Henley Shirt Grey', 'description' => 'Áo henley cổ 3 nút màu xám.', 'price' => 280000, 'stock' => 35, 'category_id' => $shirtsId, 'image' => 'ao-6.jpg'],
            ['name' => 'T-Shirt Graphic Print', 'description' => 'Áo thun in họa tiết.', 'price' => 200000, 'stock' => 45, 'category_id' => $shirtsId, 'image' => 'ao-7.jpg'],
            ['name' => 'Cotton Shirt Pink', 'description' => 'Áo sơ mi cotton màu hồng.', 'price' => 420000, 'stock' => 18, 'category_id' => $shirtsId, 'image' => 'ao-8.jpg'],
            ['name' => 'Linen Shirt Beige', 'description' => 'Áo sơ mi linen màu be.', 'price' => 480000, 'stock' => 15, 'category_id' => $shirtsId, 'image' => 'ao-9.jpg'],
            ['name' => 'Denim Shirt', 'description' => 'Áo sơ mi denim xanh.', 'price' => 460000, 'stock' => 22, 'category_id' => $shirtsId, 'image' => 'ao-10.jpg'],

            // Shoes (10 sản phẩm)
                ['name' => 'Sneakers White', 'description' => 'Giày sneaker trắng unisex.', 'price' => 850000, 'stock' => 15, 'category_id' => $shoesId, 'image' => 'giay-1.jpg'],
            ['name' => 'Leather Boots Brown', 'description' => 'Boots da nâu nam tính.', 'price' => 1200000, 'stock' => 8, 'category_id' => $shoesId, 'image' => 'giay-2.jpg'],
            ['name' => 'Sandals Black', 'description' => 'Dép quai ngang đen.', 'price' => 250000, 'stock' => 30, 'category_id' => $shoesId, 'image' => 'giay-3.jpg'],
            ['name' => 'Running Shoes Blue', 'description' => 'Giày chạy bộ nhẹ, đệm tốt.', 'price' => 950000, 'stock' => 12, 'category_id' => $shoesId, 'image' => 'giay-4.jpg'],
            ['name' => 'Canvas Shoes', 'description' => 'Giày vải canvas cổ điển.', 'price' => 350000, 'stock' => 25, 'category_id' => $shoesId, 'image' => 'giay-5.jpg'],
            ['name' => 'High Heels Red', 'description' => 'Giày cao gót đỏ nữ tính.', 'price' => 780000, 'stock' => 10, 'category_id' => $shoesId, 'image' => 'giay-6.jpg'],
            ['name' => 'Loafers Black', 'description' => 'Giày loafers không dây.', 'price' => 650000, 'stock' => 18, 'category_id' => $shoesId, 'image' => 'giay-7.jpg'],
            ['name' => 'Sports Sandals', 'description' => 'Dép thể thao chống trơn.', 'price' => 300000, 'stock' => 20, 'category_id' => $shoesId, 'image' => 'giay-8.jpg'],
            ['name' => 'Chelsea Boots', 'description' => 'Boots chelsea cổ thấp.', 'price' => 1100000, 'stock' => 7, 'category_id' => $shoesId, 'image' => 'giay-9.jpg'],
            ['name' => 'Slippers Grey', 'description' => 'Giày lười trong nhà.', 'price' => 180000, 'stock' => 35, 'category_id' => $shoesId, 'image' => 'giay-10.jpg'],

            // Hats (10 sản phẩm)
                ['name' => 'Baseball Cap Red', 'description' => 'Mũ lưỡi trai đỏ.', 'price' => 150000, 'stock' => 40, 'category_id' => $hatsId, 'image' => 'mu-1.jpg'],
            ['name' => 'Beanie Black', 'description' => 'Mũ len tròn.', 'price' => 120000, 'stock' => 35, 'category_id' => $hatsId, 'image' => 'mu-2.jpg'],
            ['name' => 'Sun Hat Wide Brim', 'description' => 'Nón rộng vành chống nắng.', 'price' => 280000, 'stock' => 15, 'category_id' => $hatsId, 'image' => 'mu-3.jpg'],
            ['name' => 'Bucket Hat Green', 'description' => 'Mũ bucket kaki xanh.', 'price' => 180000, 'stock' => 25, 'category_id' => $hatsId, 'image' => 'mu-4.jpg'],
            ['name' => 'Trucker Hat', 'description' => 'Mũ trucker lưới sau.', 'price' => 160000, 'stock' => 30, 'category_id' => $hatsId, 'image' => 'mu-5.jpg'],
            ['name' => 'Beret Navy', 'description' => 'Mũ beret xanh navy.', 'price' => 140000, 'stock' => 20, 'category_id' => $hatsId, 'image' => 'mu-6.jpg'],
            ['name' => 'Snapback White', 'description' => 'Mũ snapback trắng.', 'price' => 170000, 'stock' => 32, 'category_id' => $hatsId, 'image' => 'mu-7.jpg'],
            ['name' => 'Cowboy Hat Brown', 'description' => 'Mũ cao bồi nâu.', 'price' => 500000, 'stock' => 5, 'category_id' => $hatsId, 'image' => 'mu-8.jpg'],
            ['name' => 'Visor Cap', 'description' => 'Mũ lưỡi trai chỉ có phần trước.', 'price' => 100000, 'stock' => 45, 'category_id' => $hatsId, 'image' => 'mu-9.jpg'],
            ['name' => 'Wool Hat Grey', 'description' => 'Mũ len nỉ xám.', 'price' => 130000, 'stock' => 28, 'category_id' => $hatsId, 'image' => 'mu-10.jpg'],

            // Bags (10 sản phẩm)
                ['name' => 'Backpack Black', 'description' => 'Ba lô unisex màu đen.', 'price' => 450000, 'stock' => 20, 'category_id' => $bagsId, 'image' => '3lo-1.jpg'],
            ['name' => 'Tote Bag Canvas', 'description' => 'Túi tote vải canvas.', 'price' => 220000, 'stock' => 35, 'category_id' => $bagsId, 'image' =>   '3lo-2.jpg'],
            ['name' => 'Crossbody Bag Brown', 'description' => 'Túi đeo chéo da nâu.', 'price' => 580000, 'stock' => 15, 'category_id' => $bagsId, 'image' => '3lo-3.jpg'],
            ['name' => 'Messenger Bag', 'description' => 'Túi đeo một vai.', 'price' => 420000, 'stock' => 18, 'category_id' => $bagsId, 'image' => '3lo-4.jpg'],
            ['name' => 'Shoulder Bag Pink', 'description' => 'Túi xách tay màu hồng.', 'price' => 500000, 'stock' => 12, 'category_id' => $bagsId, 'image' => '3lo-5.jpg'],
            ['name' => 'Laptop Bag 15"', 'description' => 'Túi đựng laptop 15 inch.', 'price' => 380000, 'stock' => 25, 'category_id' => $bagsId, 'image' => '3lo-6.jpg'],
            ['name' => 'Mini Bag', 'description' => 'Túi xách mini thời trang.', 'price' => 350000, 'stock' => 22, 'category_id' => $bagsId, 'image' => '3lo-7.jpg'],
            ['name' => 'Duffel Bag Blue', 'description' => 'Túi du lịch hình trụ xanh.', 'price' => 600000, 'stock' => 10, 'category_id' => $bagsId, 'image' => '3lo-8.jpg'],
            ['name' => 'Clutch Bag', 'description' => 'Túi cầm tay không dây.', 'price' => 300000, 'stock' => 17, 'category_id' => $bagsId, 'image' => '3lo-9.jpg'],
            ['name' => 'Fanny Pack', 'description' => 'Túi đeo hông thể thao.', 'price' => 280000, 'stock' => 30, 'category_id' => $bagsId, 'image' => '3lo-10.jpg'],
        ];

        if (!isset($pantsId, $shirtsId, $shoesId, $hatsId, $bagsId)) {
            $this->command->error('Vui lòng đảm bảo các danh mục Pants, Shirts, Shoes, Hats, Bags đã tồn tại trong DB trước khi chạy ProductSeeder.');
            return;
        }

        foreach ($products as $product) {
            Product::create($product);
        }

        
    }
}
