<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

// Check product with image
use App\Models\Product;
$product = Product::first();
echo "Product: " . $product->name . "\n";
echo "Image URL: " . $product->image_url . "\n";
echo "Asset URL: " . asset('images/' . $product->image_url) . "\n";
echo "File exists: " . (file_exists('public/images/' . $product->image_url) ? 'YES' : 'NO') . "\n";

// List all files in public/images
echo "\nFiles in public/images:\n";
$files = glob('public/images/*');
foreach ($files as $file) {
    echo "- " . basename($file) . "\n";
}
?>
