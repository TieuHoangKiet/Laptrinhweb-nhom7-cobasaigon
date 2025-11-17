<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$u = User::where('email', 'admin@cobasaigon.com')->first();

if (!$u) {
    echo "User not found\n";
    exit(1);
}

echo "ID: " . $u->id . "\n";
echo "Email: " . $u->email . "\n";
echo "Role: " . $u->role . "\n";
echo "Password Hash: " . substr($u->password, 0, 20) . "...\n";
echo "Match 123456: " . (Hash::check('123456', $u->password) ? 'YES' : 'NO') . "\n";
