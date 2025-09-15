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
        Schema::table('aipr_masters', function (Blueprint $table) {
            $table->tinyInteger('is_approved')->default(0)->comment('0:Pending,1:Approved;2:Rejected')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aipr_masters', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });
    }
};
