<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingScaleProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_scale_programs', function (Blueprint $table) {
            $table->unsignedBigInteger('map_scale_id');
            $table->unsignedBigInteger('program_id');
            $table->timestamps();

            $table->primary(['map_scale_id', 'program_id']);
            $table->foreign('map_scale_id')->references('map_scale_id')->on('mapping_scales')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mapping_scale_programs');
    }
}
