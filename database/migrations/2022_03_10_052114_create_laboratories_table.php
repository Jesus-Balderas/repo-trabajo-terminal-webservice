<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('classroom');
            $table->string('edifice');
            $table->string('status')->default('Abierto');
            $table->string('file_path')->nullable();
            $table->unsignedInteger('attendant_id');
            $table->foreign('attendant_id')->references('id')->on('attendants');
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
        Schema::dropIfExists('laboratories');
    }
}
