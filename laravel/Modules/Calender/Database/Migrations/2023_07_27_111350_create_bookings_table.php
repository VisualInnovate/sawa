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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('user_id');
            //Requester Info
            $table->string('requester_name');
            $table->string('requester_phone');
            $table->string('relative_degree');
            //Addtional Phone Info
            $table->string('addtional_phone')->nullable();
            $table->string('addtional_phone_owner')->nullable();
            $table->string('addtional_phone_degree')->nullable();
            //Child Info
            $table->string('child_name');
            $table->enum('child_gender', Gender::values());
            $table->string('child_lang');
            $table->string('child_nationalty');
            $table->string('child_national_id');
            $table->date('child_birth_date');
            $table->string('child_birth_place');
            $table->string('child_address');
            $table->string("conversion_type");
            $table->string('child_doctor');

            $table->string('child_problem');
            $table->text('child_problems_notes');

            $table->boolean("child_aids");
            $table->text("child_aids_notes")->nullable();


            $table->text('child_parents_problems');
            $table->text('parents_priorities');

            $table->unsignedBigInteger("doctor_code");



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
        Schema::dropIfExists('bookings');
    }
};
