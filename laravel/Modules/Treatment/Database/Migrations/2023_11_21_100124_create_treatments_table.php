<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->foreignId('program_type_id')->references('id')->on('program_types')->cascadeOnDelete();
            $table->foreignId('program_system_id')->references('id')->on('program_systems')->cascadeOnDelete();
            $table->foreignId('treatment_type_id')->references('id')->on('treatment_types')->cascadeOnDelete();
            $table->foreignId('appointment_type_id')->references('id')->on('appointment_types')->cascadeOnDelete();
            $table->foreignId('session_type_id')->references('id')->on('session_types')->cascadeOnDelete();
     
        
            $table->unsignedBigInteger("room_id");
            $table->unsignedBigInteger("user_id");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments');
    }
};
