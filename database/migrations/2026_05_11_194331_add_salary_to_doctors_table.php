<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // database/migrations/xxxx_add_salary_to_doctors_table.php
public function up()
{
    Schema::table('doctors', function (Blueprint $table) {
        $table->decimal('salary', 8, 2)->default(0)->after('rating');
    });
}

public function down()
{
    Schema::table('doctors', function (Blueprint $table) {
        $table->dropColumn('salary');
    });
}
};
