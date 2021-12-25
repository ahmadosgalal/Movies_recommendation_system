<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_seats', function (Blueprint $table) {
            $table->integer('movie_id')->unsigned();
            $table->integer('seat_id')->unsigned();
            $table->integer('reservation_id')->unsigned()->nullable();
            $table->integer('available')->default(1);
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');
            $table->foreign('seat_id')
                ->references('id')
                ->on('seats')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_seats');
    }
}
