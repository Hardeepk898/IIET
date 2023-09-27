<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionEducationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_education_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('admission_id')->unsigned();
            $table->foreign('admission_id')->references('id')->on('admission');
            $table->string('examination',500)->nullable();
            $table->string('university',500)->nullable();
            $table->integer('passing_year')->default(0);
            $table->double('total_marks')->default(0);
            $table->double('percentage_marks')->default(0);
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
        Schema::dropIfExists('admission_education_details');
    }
}
