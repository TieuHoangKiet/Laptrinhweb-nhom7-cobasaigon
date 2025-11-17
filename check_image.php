<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Product;

$product = Product::where('name', 'Slim Fit Jeans')->first();

if ($product) {
    echo "Product: " . $product->name . "\n";
    echo "Image URL: " . ($product->image_url ?? 'NULL') . "\n";
    echo "Category: " . $product->category_id . "\n";
    echo "ID: " . $product->id . "\n";
} else {
    echo "Product not found!\n";
}

// Check first 5 products
echo "\nFirst 5 products with image_url:\n";
$products = Product::limit(5)->get();
foreach ($products as $p) {
    echo "- {$p->name}: " . ($p->image_url ?? 'NULL') . "\n";
}
?>
