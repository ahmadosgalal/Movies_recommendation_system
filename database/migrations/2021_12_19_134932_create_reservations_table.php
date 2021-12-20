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
            $table->unsignedInteger('user-id');
            $table->unsignedInteger('room-id');
            $table->unsignedInteger('movie-id');
            $table->unsignedInteger('seat-id');
            $table->time('time-slot');
            $table->date('date'); // reservation day
            $table->date('creation_date');
            $table->date('updated_date');

            $table->foreign('room-id')
            ->references('id')->on('rooms');

            $table->foreign('user-id')
            ->references('id')->on('users');

            $table->foreign('movie-id')
            ->references('id')->on('movies');
                        
            $table->foreign('seat-id')
            ->references('id')->on('seats');

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
