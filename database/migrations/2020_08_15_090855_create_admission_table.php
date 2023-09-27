<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname',200)->nullable();
            $table->string('lastname',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('phone',100)->nullable();
            $table->date('dob')->nullable();
            $table->string('guardian_name',200)->nullable();
            $table->string('religion',200)->nullable();
            $table->integer('gender')->default(0);
            $table->string('address1',500)->nullable();
            $table->string('address2',500)->nullable();
            $table->string('city',300)->nullable();
            $table->string('state',300)->nullable();
            $table->string('country',300)->nullable();
            $table->string('postcode',300)->nullable();
            $table->string('course',300)->nullable();
            $table->string('center',300)->nullable();
            $table->integer('category')->default(0);
            $table->string('school_name',500)->nullable();
            $table->string('class',300)->nullable();
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
        Schema::dropIfExists('admissions');
    }
}
