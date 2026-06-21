<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up() {
    Schema::table('patients', function (Blueprint $table) {
        $table->string('firstname')->after('user_id');
        $table->string('lastname')->after('firstname')->nullable();
        $table->string('avatar')->after('address')->default('user.jpg');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            //
        });
    }
};
