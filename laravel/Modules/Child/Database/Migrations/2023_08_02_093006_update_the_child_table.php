<?php

use App\Enums\Gender;
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
        Schema::table('children', function (Blueprint $table) {
            $table->enum('gender', Gender::values());
            $table->string('lang');
            $table->string('nationalty');
            $table->string('national_id');
            $table->string('birth_place');
            $table->string('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'lang',
                'nationalty',
                'national_id',
                'birth_place',
                'address',
            ]);
        });
    }
};
