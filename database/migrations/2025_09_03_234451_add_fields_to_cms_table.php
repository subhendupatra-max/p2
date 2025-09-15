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
            $table->foreignId('hindi_approver_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('hindi_reviewer_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->integer('hindi_approver_status')->default(0);
            $table->integer('hindi_reviewer_status')->default(0);
            $table->integer('hindi_contant_creator_status')->default(0);
            $table->integer('english_contant_creator_status')->default(0);
            $table->longText('task')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->dropColumn('hindi_approver_id');
            $table->dropColumn('hindi_reviewer_id');
            $table->dropColumn('hindi_approver_status');
            $table->dropColumn('hindi_reviewer_status');
            $table->dropColumn('hindi_contant_creator_status');
            $table->dropColumn('english_contant_creator_status');
            $table->dropColumn('task');
        });
    }
};
