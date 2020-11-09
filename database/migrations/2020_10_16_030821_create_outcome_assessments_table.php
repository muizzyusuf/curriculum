<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutcomeAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcome_assessments', function (Blueprint $table) {
            $table->unsignedBigInteger('l_outcome_id');
            $table->unsignedBigInteger('a_method_id');
            $table->timestamps();

            $table->primary(['l_outcome_id','a_method_id']);
            $table->foreign('l_outcome_id')->references('l_outcome_id')->on('learning_outcomes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('a_method_id')->references('a_method_id')->on('assessment_methods')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outcome_assessments');
    }
}
