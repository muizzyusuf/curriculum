<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('course_id');
            $table->string('course_code');
            $table->unsignedBigInteger('course_num');
            $table->string('course_title');
            $table->unsignedBigInteger('program_id');
            $table->integer('status')->default('-1');
            $table->integer('assigned');
            $table->integer('required')->nullable();
            $table->string('type');
            $table->timestamps();

            $table->foreign('program_id')->references('program_id')->on('programs')->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
