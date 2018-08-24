<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('nickname', 50);
            $table->string('occupation', 50);
            $table->string('phone_number', 20)->nullable();
            $table->string('skype', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->char('ismain', 1)->nullable();
            $table->string('notes', 250)->nullable();
            $table->integer('status')->nullable();
            $table->unsignedInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools');
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
        Schema::dropIfExists('school_contacts');
    }
}
