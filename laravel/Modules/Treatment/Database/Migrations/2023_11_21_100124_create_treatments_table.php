<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->foreignId('thierbst_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('thierbst_schedule_id')->references('id')->on('parents')->cascadeOnDelete();
            $table->foreignId('assessment_type_id')->references('id')->on('session_types')->cascadeOnDelete();
            $table->integer('user_id')->unsigned();

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
