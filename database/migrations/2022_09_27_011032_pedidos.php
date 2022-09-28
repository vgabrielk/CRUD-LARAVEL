<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->date('data')->default(date('Y-m-d H:i:s'));
            $table->enum('status', ['ATIVO', 'EXCLUIDO']);
            $table->unsignedBigInteger('produto_id');
            $table->date('data_adicionado')->default(date('Y-m-d H:i:s'));
            $table->date('data_excluido')->default(date('Y-m-d H:i:s'))->nullable();
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
