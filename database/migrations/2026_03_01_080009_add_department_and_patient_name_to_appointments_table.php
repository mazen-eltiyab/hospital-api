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
    Schema::table('appointments', function (Blueprint $table) {
        $table->string('department')->after('patient_id')->nullable();
        $table->string('patient_name')->after('department')->nullable();
    });
}

public function down()
{
    Schema::table('appointments', function (Blueprint $table) {
        $table->dropColumn(['department', 'patient_name']);
    });
}
};
