<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->char('sex', 1)->nullable();
            $table->string('nationality', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('tel', 20)->nullable();
            $table->string('tel_mobile', 20)->nullable();
            $table->string('tel_emergency', 20)->nullable();
            $table->string('tel_emergency_dec', 255)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('street2', 255)->nullable();
            $table->string('postcode', 255)->nullable();
            $table->text('notes')->nullable();
            $table->text('notes_private')->nullable();
            $table->string('webmidia_uid', 50)->nullable();
            $table->integer('status')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedInteger('zone_id')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->unsignedInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('customer_types');
            $table->unsignedInteger('webmidia_id')->nullable();
            $table->foreign('webmidia_id')->references('id')->on('webmidias');
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
        Schema::dropIfExists('customers');
    }
}
