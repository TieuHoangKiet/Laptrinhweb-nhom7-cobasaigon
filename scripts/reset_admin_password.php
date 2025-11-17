<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$email = 'admin@cobasaigon.com';
$user = User::where('email', $email)->first();
if (! $user) {
    echo "ADMIN_NOT_FOUND\n";
    exit(1);
}

$user->password = '123456';
$user->save();

echo "RESET_OK id={$user->id} email={$user->email}\n";
