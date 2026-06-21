<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('doctors', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name')->nullable();
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->date('dob')->nullable();
        $table->enum('gender', ['Male', 'Female'])->nullable();
        $table->text('address')->nullable();
        $table->string('country')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('postal_code')->nullable();
        $table->string('phone')->nullable();
        $table->string('avatar')->nullable();
        $table->text('biography')->nullable();
        $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
        $table->timestamps();
    });
}
















    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
