<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Product;

// Danh sách ảnh
$images = ['quan_1.png', 'quan_2.png'];
$imageIndex = 0;

// Update tất cả sản phẩm với image_url
$products = Product::all();
foreach ($products as $product) {
    $product->update(['image_url' => $images[$imageIndex % 2]]);
    $imageIndex++;
}

echo "Updated " . count($products) . " products with image_url\n";

// Kiểm tra
$check = Product::where('name', 'Slim Fit Jeans')->first();
if ($check) {
    echo "Slim Fit Jeans now has image: " . ($check->image_url ?? 'NULL') . "\n";
}
?>
