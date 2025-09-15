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
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_hi')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_hi')->nullable();
            $table->string('file')->nullable();
            $table->string('link')->nullable();
            $table->string('date')->nullable();
            $table->string('file_size')->nullable();
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->tinyInteger('is_active')->default(1)->comment('0:Inactive,1:Active')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0:assigned,1:contant written done,2:contant approved done')->nullable();
            $table->tinyInteger('view_type')->default(1)->comment('1:Description View,2:List View')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms');
    }
};
