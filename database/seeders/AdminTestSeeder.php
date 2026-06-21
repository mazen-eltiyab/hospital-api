<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // مصفوفة ببيانات المديرين لتقليل تكرار الكود
        $admins = [
            [
                'name' => 'Admin Test',
                'email' => 'admin@test.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ],
            [
                'name' => 'Admin2 Test',
                'email' => 'admin@test2.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ],

            [
                'name' => 'Admin3 Test',
                'email' => 'admin@test3.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ],
        ];

        foreach ($admins as $admin) {
            User::firstOrCreate(
                ['email' => $admin['email']], // يبحث بهذا الحقل فقط
                $admin // إذا لم يجده، ينشئ السجل بهذه البيانات
            );
        }
    }
}