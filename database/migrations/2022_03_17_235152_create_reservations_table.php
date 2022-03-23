<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            //fk laboratorio
            $table->unsignedInteger('laboratory_id');
            $table->foreign('laboratory_id')->references('id')->on('laboratories');
            //fk encargado
            $table->unsignedInteger('attendant_id');
            $table->foreign('attendant_id')->references('id')->on('attendants');
            //fk computadora
            $table->unsignedInteger('computer_id');
            $table->foreign('computer_id')->references('id')->on('computers');
            //fk alumno
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->date('schedule_date');
            $table->time('schedule_time');
            //Reservada, Confirmada, Finalizada
            $table->string('status')->default('Reservada');

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
        Schema::dropIfExists('reservations');
    }
}
