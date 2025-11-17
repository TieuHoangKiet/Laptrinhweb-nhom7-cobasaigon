<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = Product::orderBy('id')->limit(20)->get();
foreach ($products as $p) {
    echo sprintf("%d | %s | image=%s | image_url=%s\n", $p->id, $p->name, $p->image ?? 'NULL', $p->image_url ?? 'NULL');
}
?>