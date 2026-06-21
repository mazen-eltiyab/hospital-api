<?php
$u = App\Models\User::firstOrNew(['email' => 'admin@admin.com']);
$u->name = 'Super Admin';
$u->password = Hash::make('12345678');
$u->role = 'admin';
$u->phone = '01234567890';
$u->save();
echo "DONE CREATING ADMIN\n";
