<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero');
            $table->text('detalles');
            $table->integer('valor');
            $table->String('archivo');
            $table->unsignedBigInteger('idcliente')->unsigned();
            $table->foreign('idcliente')->references('id')->on('clientes');
            $table->unsignedBigInteger('idforma')->unsigned();
            $table->foreign('idforma')->references('id')->on('formaspago');
            $table->unsignedBigInteger('idestado')->unsigned();
            $table->foreign('idestado')->references('id')->on('estadosfactura');
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
        Schema::dropIfExists('facturas');
    }
};
