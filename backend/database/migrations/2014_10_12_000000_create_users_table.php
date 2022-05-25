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
            $table->id('id_user');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('type');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('id_fraction')->nullable();
            $table->foreign('id_fraction')->references('id_fraction')->on('fractions');

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
