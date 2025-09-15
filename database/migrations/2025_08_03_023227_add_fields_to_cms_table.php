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
            $table->string('need_approval')->nullable();
            $table->unsignedBigInteger('en_contant_writter_id')->nullable()->after('id');
            $table->foreign('en_contant_writter_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('hi_contant_writter_id')->nullable()->after('id');
            $table->foreign('hi_contant_writter_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('contant_approver_id')->nullable()->after('id');
            $table->foreign('contant_approver_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('contant_reviewer_id')->nullable()->after('id');
            $table->foreign('contant_reviewer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->dropForeign('cms_en_contant_writter_id_foreign');
            $table->dropForeign('cms_hi_contant_writter_id_foreign');
             $table->dropColumn('en_contant_writter_id');
             $table->dropColumn('hi_contant_writter_id');
            $table->dropForeign('cms_contant_approver_id_foreign');
            $table->dropColumn('contant_approver_id');
            $table->dropForeign('cms_contant_reviewer_id_foreign');
            $table->dropColumn('contant_reviewer_id');
            $table->dropColumn('need_approval');
        });
    }
};
