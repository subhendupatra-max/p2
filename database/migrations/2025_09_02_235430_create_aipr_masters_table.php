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
        Schema::create('aipr_masters', function (Blueprint $table) {
             $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('pno')->nullable();
            $table->string('grade')->nullable();
            $table->string('file')->nullable();
            $table->string('file_size')->nullable();
            $table->string('year')->nullable();
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->tinyInteger('is_active')->default(1)->comment('0:Inactive,1:Active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aipr_masters');
    }
};
