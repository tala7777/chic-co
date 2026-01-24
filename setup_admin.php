<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$admin = User::updateOrCreate(
    ['email' => 'admin@chic.co'],
    [
        'name' => 'Admin Curator',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]
);

echo "Admin User: admin@chic.co / password\n";
echo "Role: " . $admin->role . "\n";
