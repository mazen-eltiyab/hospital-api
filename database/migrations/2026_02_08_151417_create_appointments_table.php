<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        // ربط بالمريض
        $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
        // ربط بالدكتور (لو جدول الدكاترة عندك اسمه doctors)
        $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
        
        $table->date('appointment_date'); // يوم الحجز
        $table->time('start_time');       // ساعة البدء
        $table->time('end_time')->nullable(); // ساعة الانتهاء (اختياري)
        
        // حالة الحجز (افتراضياً بانتظار التأكيد)
        $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
        
        $table->text('notes')->nullable(); // ملاحظات إضافية
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