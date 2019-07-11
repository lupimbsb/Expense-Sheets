<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('divida_id')->unsigned();
            $table->float('porcentagem');
            $table->timestamps();
        });

        Schema::table('devedores', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('divida_id')->references('id')->on('dividas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devedores');
    }
}
