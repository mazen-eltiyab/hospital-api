<?php
require 'vendor/autoload.php'; 
$app = require_once 'bootstrap/app.php'; 
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap(); 
$user = App\Models\User::where('email', 'admin@hospital.com')->first();
if (Hash::check('password123', $user->password)) {
    echo "Match";
} else {
    echo "Mismatch. Current Hash: " . $user->password;
}
