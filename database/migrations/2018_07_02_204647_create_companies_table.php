<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('fullname', 255);
            $table->string('email', 100);
            $table->string('skype', 100);
            $table->string('tel1', 50);
            $table->string('tel2', 50);
            $table->string('tel_emergency', 50);
            $table->string('street', 255);
            $table->string('street2', 255);
            $table->string('postcode', 255);
            $table->text('notes');
            $table->integer('status');
            $table->unsignedInteger('zone_id');
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('company_types');
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
        Schema::dropIfExists('companies');
    }
}
