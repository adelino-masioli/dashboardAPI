<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('mappinglink')->nullable();
            $table->text('description')->nullable();
            $table->text('checkin_times')->nullable();
            $table->text('area_activities')->nullable();
            $table->text('driving_directions')->nullable();
            $table->text('airports')->nullable();
            $table->text('othertransport')->nullable();
            $table->text('policies_disclaimers')->nullable();
            $table->text('notes')->nullable();
            $table->integer('status');
            $table->unsignedInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');
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
        Schema::dropIfExists('school_contents');
    }
}
