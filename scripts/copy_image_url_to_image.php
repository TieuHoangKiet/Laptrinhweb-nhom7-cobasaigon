<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = Product::whereNotNull('image_url')->get();
$count = 0;
foreach ($products as $p) {
    $p->update(['image' => $p->image_url]);
    $count++;
}

echo "Copied image_url to image for $count products\n";
?>
