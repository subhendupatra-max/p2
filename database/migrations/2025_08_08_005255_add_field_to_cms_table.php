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
        Schema::table('cms', function (Blueprint $table) {
            $table->enum('approve_status',['1','0'])->default('0');
            $table->enum('review_status',['1','0'])->default('0');
            $table->enum('en_content_writting_done',['1','0'])->default('0');
            $table->enum('hi_content_writting_done',['1','0'])->default('0');
            $table->longText('approver_comment')->nullable();
            $table->longText('reviewer_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->dropColumn('approve_status');
            $table->dropColumn('review_status');
            $table->dropColumn('en_content_writting_done');
            $table->dropColumn('hi_content_writting_done');
            $table->dropColumn('approver_comment');
            $table->dropColumn('reviewer_comment');
        });
    }
};
