<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('first-name');
            $table->string('last-name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('Customer');
            $table->boolean('manager_request')-> default(false) -> nullable();
            $table->date('creation_date')->default(now());
            $table->date('updated_date')->default(now());
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
