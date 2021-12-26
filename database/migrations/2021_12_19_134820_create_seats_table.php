<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('column_number');
            $table->integer('row_number');
            $table->integer('availability'); // 0 or 1
            $table->unsignedInteger('room_id');
            $table->date('creation_date')->default(now());
            $table->date('updated_date')->default(now());
            
            $table->foreign('room_id')
            ->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
