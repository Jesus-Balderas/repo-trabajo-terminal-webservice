<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleLaboratoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_laboratories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('day');
            $table->boolean('active');
            $table->time('one_time');
            $table->time('two_time');
            $table->time('three_time');
            $table->time('four_time');
            $table->time('five_time');
            $table->time('six_time');
            $table->time('seven_time');
            $table->time('eight_time');
            $table->time('nine_time');
            $table->unsignedInteger('laboratory_id');
            $table->foreign('laboratory_id')->references('id')->on('laboratories');
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
        Schema::dropIfExists('schedule_laboratories');
    }
}
