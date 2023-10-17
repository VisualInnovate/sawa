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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'child_name',
                'child_gender',
                'child_lang',
                'child_nationalty',
                'child_national_id',
                'child_birth_date',
                'child_birth_place',
                'child_address',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('child_name');
            $table->enum('child_gender', Gender::values());
            $table->string('child_lang');
            $table->string('child_nationalty');
            $table->string('child_national_id');
            $table->date('child_birth_date');
            $table->string('child_birth_place');
            $table->string('child_address');
        });
    }
};
