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
        Schema::table('hods', function (Blueprint $table) {
            $table->string('hod_name_en')->nullable();
            $table->string('hod_name_hi')->nullable();
            $table->string('designation_en')->nullable();
            $table->string('designation_hi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hods', function (Blueprint $table) {
            $table->dropColumn('hod_name_en');
            $table->dropColumn('hod_name_hi');
            $table->dropColumn('designation_en');
            $table->dropColumn('designation_hi');
        });
    }
};
