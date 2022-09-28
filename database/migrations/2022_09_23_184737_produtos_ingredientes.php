<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProdutosIngredientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_ingredientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantidade');
            $table->unsignedBigInteger('materiaprima_id');
            $table->unsignedBigInteger('produto_id');
            $table->date('data_adicionado')->default(date('Y-m-d H:i:s'));
            $table->date('data_excluido')->default(date('Y-m-d H:i:s'))->nullable();
            $table->foreign('materiaprima_id')->references('id')->on('materiaprima');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos_ingredientes');
    }
}
