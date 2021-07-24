<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('speciality_id');

           $table->string('date_of_birth',255)->default(0);
           $table->string('registrationNo',255)->default(0);
            $table->string('whatsapp')->default(0);
            $table->string('about')->default(0);
            $table->string('experience')->default(0);
            $table->string('fee',255)->default(0);
            $table->string('city',255)->default(0);
            $table->string('address',255)->default(0);
            $table->string('image')->default(0);
            $table->timestamps();

            $table->foreign('speciality_id')->references('id')->on('specialities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
