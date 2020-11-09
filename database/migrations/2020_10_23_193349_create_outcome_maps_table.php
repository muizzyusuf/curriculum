<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutcomeMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcome_maps', function (Blueprint $table) {
            $table->unsignedBigInteger('l_outcome_id');
            $table->unsignedBigInteger('pl_outcome_id');
            $table->string('map_scale_value');
            $table->timestamps();

            $table->primary(['l_outcome_id','pl_outcome_id']);
            $table->foreign('l_outcome_id')->references('l_outcome_id')->on('learning_outcomes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pl_outcome_id')->references('pl_outcome_id')->on('program_learning_outcomes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outcome_maps');
    }
}
