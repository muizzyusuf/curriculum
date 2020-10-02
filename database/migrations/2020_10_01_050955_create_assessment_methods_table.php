<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_methods', function (Blueprint $table) {
            $table->unsignedBigInteger('l_outcome_id');
            $table->string('assessment_method');
            $table->timestamps();

            $table->primary(['l_outcome_id','assessment_method']);
            $table->foreign('l_outcome_id')->references('l_outcome_id')->on('learning_outcomes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_methods');
    }
}
