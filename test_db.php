<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Users role=doctor:\n";
foreach (\App\Models\User::where('role', 'doctor')->get() as $u) {
    echo "ID: {$u->id}, Name: {$u->name}, Email: {$u->email}\n";
}

echo "\nDoctors table:\n";
foreach (\App\Models\Doctor::all() as $d) {
    echo "ID: {$d->id}, Name: {$d->first_name}, Email: {$d->email}\n";
}
