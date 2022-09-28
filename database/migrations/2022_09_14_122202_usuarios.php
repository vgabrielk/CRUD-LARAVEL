<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_idtipo')->unsigned();
            $table->string('nome');
            $table->string('email');
            $table->string('senha');
            $table->enum('status', ['ATIVO', 'INATIVO', 'EXCLUIDO'])->default('ATIVO');
            $table->date('data_adicionado')->default(date('Y-m-d H:i:s'));
            $table->date('data_excluido')->default(date('Y-m-d H:i:s'));
            $table->foreign('usuario_idtipo')->references('id')->on('usuarios_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
