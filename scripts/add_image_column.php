<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if (!Schema::hasColumn('products', 'image')) {
    Schema::table('products', function (Blueprint $table) {
        $table->string('image')->nullable()->after('image_url');
    });
    echo "Added column 'image' to products table\n";
} else {
    echo "Column 'image' already exists\n";
}
?>
