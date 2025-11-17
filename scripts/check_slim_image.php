<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$product = Product::where('name', 'Slim Fit Jeans')->first();
if (! $product) {
    echo "Product not found\n";
    exit(1);
}
echo "DB image: " . ($product->image ?? 'NULL') . "\n";
echo "DB image_url: " . ($product->image_url ?? 'NULL') . "\n";
$img = $product->image ?? $product->image_url;
if ($img) {
    $path = __DIR__ . '/../public/images/' . $img;
    echo "Expected file path: " . $path . "\n";
    echo "File exists: " . (file_exists($path) ? 'YES' : 'NO') . "\n";
    if (!file_exists($path)) {
        // List files in images dir
        echo "Files in public/images:\n";
        foreach (glob(__DIR__ . '/../public/images/*') as $f) {
            echo "- " . basename($f) . "\n";
        }
    }
} else {
    echo "No image or image_url set on product.\n";
}
?>