<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
use Illuminate\Contracts\Console\Kernel;
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Product;

$placeholder = 'placeholder-shirt.svg';
$shirts = Category::where('name', 'Shirts')->first();
if (! $shirts) {
    echo "Category 'Shirts' not found.\n";
    exit(1);
}

$products = Product::where('category_id', $shirts->id)->whereNull('image')->orderBy('id')->get();
if ($products->isEmpty()) {
    echo "No Shirts products with NULL image found.\n";
    exit(0);
}

foreach ($products as $product) {
    $product->image = $placeholder;
    $product->save();
    echo "Updated product ID {$product->id} -> {$placeholder}\n";
}

echo "Done. Updated {$products->count()} Shirt products.\n";
