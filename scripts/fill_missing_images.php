<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$default = 'quan_1.png';
$products = Product::whereNull('image')->get();
$count = 0;
foreach ($products as $p) {
    $p->update(['image' => $default]);
    $count++;
}

echo "Filled $count products with default image ($default)\n";
?>