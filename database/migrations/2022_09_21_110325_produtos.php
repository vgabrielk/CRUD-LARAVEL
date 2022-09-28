<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produtos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('marca_id');
            $table->enum('status', ['ATIVO', 'INATIVO', 'EXCLUIDO'])->default('ATIVO');
            $table->date('data_adicionado')->default(date('Y-m-d H:i:s'));
            $table->date('data_excluido')->default(date('Y-m-d H:i:s'));
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('marca_id')->references('id')->on('marcas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
