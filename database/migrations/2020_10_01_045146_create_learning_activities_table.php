<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('l_outcome_id');
            $table->string('l_activity');
            $table->timestamps();

            $table->primary(['l_outcome_id','l_activity']);
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
        Schema::dropIfExists('learning_activities');
    }
}
