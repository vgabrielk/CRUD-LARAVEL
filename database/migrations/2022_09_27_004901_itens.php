<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Itens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produto_id');
            $table->integer('quantidade');
            $table->integer('valor_produto');
            $table->string('nome_produto');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }
    public function down()
    {
        Schema::dropIfExists('itens');
    }
}
