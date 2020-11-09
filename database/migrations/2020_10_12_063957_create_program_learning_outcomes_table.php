<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramLearningOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_learning_outcomes', function (Blueprint $table) {
            $table->bigIncrements('pl_outcome_id');
            $table->string('plo_shortphrase')->nullable();
            $table->text('pl_outcome');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('plo_category_id')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('program_id')->on('programs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('plo_category_id')->references('plo_category_id')->on('p_l_o_categories')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_learning_outcomes');
    }
}