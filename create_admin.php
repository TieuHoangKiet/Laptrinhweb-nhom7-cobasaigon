<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

// Kiểm tra xem admin đã tồn tại chưa
$admin = User::where('email', 'admin@cobasaigon.com')->first();
if ($admin) {
    echo "Admin đã tồn tại: " . $admin->email . "\n";
    exit(0);
}

// Tạo admin mới (dùng password dạng plain, model sẽ hash)
$admin = User::create([
    'name' => 'Admin User',
    'email' => 'admin@cobasaigon.com',
    'password' => '123456',
    'role' => 'admin',
]);

echo "Tài khoản admin đã được tạo:\n";
echo "Email: " . $admin->email . "\n";
echo "Mật khẩu: 123456\n";
echo "Role: " . $admin->role . "\n";
