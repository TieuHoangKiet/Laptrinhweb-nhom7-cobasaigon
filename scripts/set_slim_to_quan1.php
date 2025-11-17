<?php/*
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$p = Product::where('name', 'Slim Fit Jeans')->first();
if (! $p) {
    echo "Product not found\n";
    exit(1);
}

$p->update(['image' => 'quan_1.png', 'image_url' => 'quan_1.png']);
echo "Set product id {$p->id} image => quan_1.png\n";*/
?>