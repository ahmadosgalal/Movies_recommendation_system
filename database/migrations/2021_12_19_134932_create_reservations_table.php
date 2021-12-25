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
            $table->unsignedInteger('movie-id');
            $table->date('creation_date')->default(now());
            $table->date('updated_date')->default(now());


            $table->foreign('user-id')
            ->references('id')->on('users');

            $table->foreign('movie-id')
            ->references('id')->on('movies');
                        
            
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
