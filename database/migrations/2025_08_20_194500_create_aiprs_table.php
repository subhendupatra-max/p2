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
        Schema::create('aiprs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->string('type')->nullable()->comment('active,retired');
            $table->string('pno')->nullable()->comment('Personal Number');
            $table->string('name')->nullable()->comment('Name of the Officer');
            $table->string('unit')->nullable()->comment('Unit of the Officer');
            $table->string('dpsu')->nullable()->comment('DPSU of the Officer');
            $table->string('grade')->nullable()->comment('Grade of the Officer');
            $table->string('designation')->nullable()->comment('Designation of the Officer');
            $table->date('doj_iofs')->nullable()->comment('Date of Joining in IOFS');
            $table->date('dob')->nullable()->comment('Date of Birth');
            $table->date('dor')->nullable()->comment('Date of Retirement');
            $table->text('address')->nullable()->comment('Address of the Officer');
            $table->string('sex')->nullable()->comment('Gender of the Officer');
            $table->string('sno')->nullable()->comment('Serial Number');
            $table->string('others')->nullable()->comment('Any other information');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->tinyInteger('is_active')->default(1)->comment('0:Inactive,1:Active')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aiprs');
    }
};
