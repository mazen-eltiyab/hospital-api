<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            // إضافة الأعمدة العربية الجديدة فقط دون المساس بالأعمدة القديمة
            $table->string('address_ar')->nullable()->after('address');
            $table->string('country_ar')->nullable()->after('country');
            $table->string('city_ar')->nullable()->after('city');
            $table->text('bio_ar')->nullable()->after('bio');
        });
    }

    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            // حذف الأعمدة العربية فقط في حال عمل rollback لتفريغ الجدول منها
            $table->dropColumn(['address_ar', 'country_ar', 'city_ar', 'bio_ar']);
        });
    }
};