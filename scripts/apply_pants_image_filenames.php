<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
use Illuminate\Contracts\Console\Kernel;
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Product;

$files = [
    'quan-1.jpg',
    'quan-2.png',
    'quan-3.jpg',
    'quan-4.jpg',
    'quan-5.jpg',
    'quan-6.jpg',
    'quan-7.jpg',
    'quan-8.jpg',
    'quan-9.jpg',
    'quan-10.jpg',
];

$pants = Category::where('name', 'Pants')->first();
if (! $pants) {
    echo "Category 'Pants' not found.\n";
    exit(1);
}

$products = Product::where('category_id', $pants->id)->orderBy('id')->get();
if ($products->isEmpty()) {
    echo "No products found in Pants category.\n";
    exit(0);
}

$i = 0;
foreach ($products as $product) {
    if ($i >= count($files)) break;
    $filename = $files[$i];
    // Only update if file exists on disk, otherwise skip
    if (file_exists(__DIR__ . '/../public/images/' . $filename)) {
        $product->image = $filename;
        $product->save();
        echo "Updated product ID {$product->id} -> {$filename}\n";
    } else {
        echo "Skipped product ID {$product->id}: file {$filename} not found on disk\n";
    }
    $i++;
}

echo "Done. Updated {$i} entries (attempted).\n";
