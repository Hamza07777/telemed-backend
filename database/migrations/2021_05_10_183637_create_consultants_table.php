<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->default(0);
            $table->string('email', 100)->default(0);
            $table->string('password', 100)->default(0);
            $table->string('otp', 100)->default(0);
            $table->string('speciality', 100)->default(0);
            $table->string('commission', 100)->default(0);
            $table->string('status', 100)->default(0);
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
        Schema::dropIfExists('consultants');
    }
}
