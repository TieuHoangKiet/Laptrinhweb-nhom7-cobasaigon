<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
use Illuminate\Contracts\Console\Kernel;
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Product;

$shirts = Category::where('name', 'Shirts')->first();
if (! $shirts) {
    echo "Category 'Shirts' not found.\n";
    exit(1);
}
$products = Product::where('category_id', $shirts->id)->orderBy('id')->get();
if ($products->isEmpty()) {
    echo "No Shirts products found.\n";
    exit(0);
}

foreach ($products as $p) {
    printf("ID: %d | %-30s | image: %s\n", $p->id, $p->name, $p->image === null ? 'NULL' : $p->image);
}

echo "Total: " . $products->count() . "\n";
