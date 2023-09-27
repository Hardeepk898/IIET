<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserJobTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_job_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('admission_id')->unsigned();
            $table->foreign('admission_id')->references('id')->on('admission');
            $table->integer('job_type_id')->default(0);
            $table->foreign('job_type_id')->references('id')->on('job_types');
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
        Schema::dropIfExists('admission_job_types');
    }
}
