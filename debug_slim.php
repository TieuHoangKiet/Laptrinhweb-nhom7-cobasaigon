<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$p = Product::where('name', 'Slim Fit Jeans')->first();
if ($p) {
    echo "ID: {$p->id}\n";
    echo "Name: {$p->name}\n";
    echo "Image: " . ($p->image ?? 'NULL') . "\n";
    echo "Image_url: " . ($p->image_url ?? 'NULL') . "\n";
    if ($p->image) {
        echo "Full path: " . asset('images/' . $p->image) . "\n";
        $file = __DIR__ . '/public/images/' . $p->image;
        echo "File exists: " . (file_exists($file) ? 'YES' : 'NO') . "\n";
    }
} else {
    echo "Product not found\n";
}
?>
