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
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->string('appointment_id')->unique(); // APT-0001
        $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
        $table->string('department')->nullable();
        $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
        $table->date('appointment_date');
        $table->time('appointment_time');
        $table->string('patient_email')->nullable();
        $table->string('patient_phone')->nullable();
        $table->text('message')->nullable();
        $table->boolean('status')->default(1);
        $table->timestamps();
    });
}
















    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
