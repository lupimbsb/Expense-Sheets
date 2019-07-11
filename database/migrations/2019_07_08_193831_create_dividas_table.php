<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDividasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dividas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('criador_id')->unsigned();
            $table->integer('tipo_id')->unsigned();
            $table->string('tipo_desc');
            $table->float('valor');
            $table->timestamp('data_referencia');
            $table->timestamps();
        });

        Schema::table('dividas', function($table) {
            $table->foreign('criador_id')->references('id')->on('users');
            $table->foreign('tipo_id')->references('id')->on('tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dividas');
    }
}
