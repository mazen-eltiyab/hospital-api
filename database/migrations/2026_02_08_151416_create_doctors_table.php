<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('doctors', function (Blueprint $table) {
        $table->id();
        $table->string('firstname');
        $table->string('lastname')->nullable();
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->date('dob')->nullable();
        $table->string('gender');
        $table->string('address')->nullable();
        $table->string('country')->nullable();
        $table->string('city')->nullable();
        $table->string('phone')->nullable();
        $table->string('avatar')->default('user.jpg');
        $table->text('bio')->nullable();
        $table->boolean('status')->default(true);
        $table->timestamps();
    });
}

// أضف هذه الدالة لضمان عمل الـ Refresh والـ Rollback بشكل صحيح
public function down()
{
    Schema::dropIfExists('doctors');
}
};