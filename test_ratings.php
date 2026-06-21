<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('role', 'admin')->first();
$token = $user->createToken('test')->plainTextToken;

$response = Http::withToken($token)->post('http://localhost:8000/api/admin/doctors/10/rating', [
    'rating' => 5.0,
    'review' => 'good j'
]);
echo "Status: " . $response->status() . "\n";
echo $response->body();

