<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 70);
            $table->string('fullname', 200)->nullable();
            $table->char('tel', 30)->nullable();
            $table->char('tel_emergency', 30)->nullable();
            $table->char('tel_fax', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('site', 100)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('address_complement', 200)->nullable();
            $table->char('postcode', 50)->nullable();
            $table->string('logo', 100)->nullable();
            $table->char('stars', 45)->nullable();
            $table->char('lat', 13)->nullable();     
            $table->char('long', 13)->nullable();
            $table->char('approved', 45)->nullable();
            $table->text('notes_private')->nullable();    
            $table->integer('status')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedInteger('zone_id')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->unsignedInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('agencies');
    }
}
