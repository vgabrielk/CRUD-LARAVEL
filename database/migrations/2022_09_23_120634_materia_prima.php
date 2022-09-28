<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MateriaPrima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiaprima', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantidade');
            $table->string('unidade_medida');
            $table->string('preco_compra');
            $table->string('fornecedor');
            $table->string('link_fornecedor');
            $table->date('data_adicionado')->default(date('Y-m-d H:i:s'));
            $table->date('data_excluido')->default(date('Y-m-d H:i:s'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('materiaprima');
    }
}
