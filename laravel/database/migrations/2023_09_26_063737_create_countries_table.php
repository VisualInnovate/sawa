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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->index();
            $table->string('country')->nullable();
            $table->string('nationality')->nullable();
            $table->tinyInteger('is_default')->nullable()->default(0);
            $table->tinyInteger('is_active')->nullable()->default(0);
            $table->unsignedInteger('sort_order')->nullable()->default(0);
            $table->string('lang', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
