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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('form_validation_otp')->nullable();
            $table->timestamp('form_validation_otp_time')->nullable();
            $table->integer('form_validation_no_of_attempted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('form_validation_otp');
            $table->dropColumn('form_validation_otp_time');
            $table->dropColumn('form_validation_no_of_attempted');
        });
    }
};
