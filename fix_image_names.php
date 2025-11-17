<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

// Update Slim Fit Jeans
$p = Product::where('name', 'Slim Fit Jeans')->first();
if ($p) {
    $p->update(['image' => 'quan-1.png']);
    echo "Updated: Slim Fit Jeans => quan-1.png\n";
}

// Update all products that have quan_1.png
Product::where('image', 'quan_1.png')->update(['image' => 'quan-1.png']);
echo "Updated all quan_1.png => quan-1.png\n";

// Update all products that have quan_2.png
Product::where('image', 'quan_2.png')->update(['image' => 'quan-2.png']);
echo "Updated all quan_2.png => quan-2.png\n";
?>
