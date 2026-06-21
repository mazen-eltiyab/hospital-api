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
    Schema::create('medical_reports', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('patient_id'); // رقم المريض
        $table->unsignedBigInteger('doctor_id');  // رقم الدكتور
        $table->text('report_content');           // نص التقرير
        $table->string('file_path')->nullable();  // إذا كان هناك ملف مرفق
        $table->timestamps();

        // ربط الجداول (Foreign Keys)
        $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_reports');
    }
};
