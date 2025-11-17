<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Check total users and list first 10
$email = 'admin@cobasaigon.com';

$count = User::count();
echo "users_count: {$count}\n";

$users = User::orderBy('id')->limit(10)->get();
foreach ($users as $u) {
    echo "#{$u->id}\t{$u->email}\trole={$u->role}\n";
}

$user = User::where('email', $email)->first();
if (! $user) {
    echo "\nAdmin with email {$email} NOT FOUND\n";
    exit(0);
}

echo "\nFOUND ADMIN:\n";
echo "id: {$user->id}\n";
echo "email: {$user->email}\n";
echo "role: {$user->role}\n";
echo "password_hash: {$user->password}\n";
$check = Hash::check('123456', $user->password) ? 'MATCH' : 'NO_MATCH';
echo "check_password_123456: {$check}\n";

if (property_exists($user, 'email_verified_at')) {
    echo "email_verified_at: " . ($user->email_verified_at ? $user->email_verified_at : 'NULL') . "\n";
}
