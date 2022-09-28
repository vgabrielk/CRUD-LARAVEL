<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// USUARIOS TIPOS
Route::controller(\App\Http\Controllers\UsuarioTipoController::class)->group(function(){
    Route::get('/usuariostipos',  'index')->name('usuarios_tipos.index');
    Route::post('/usuariostipos/create',  'create')->name('usuarios_tipos.create');
    Route::delete('/usuariostipos/deletar/{id}',  'destroy')->name('usuarios_tipos.destroy');
    Route::put('/usuariostipos/update/{id}',  'update')->name('usuarios_tipos.update');
});

// USUARIOS
Route::controller(\App\Http\Controllers\UsuarioController::class)->group(function(){
    Route::get('/usuarios',  'index')->name('usuarios.index');
    Route::post('/usuarios/create',  'create')->name('usuarios.create');
    Route::delete('/usuarios/deletar/{id}',  'destroy')->name('usuarios.destroy');
    Route::put('/usuarios/update/{id}',  'update')->name('usuarios.update');
});

//MARCAS
Route::controller(\App\Http\Controllers\MarcaController::class)->group(function(){
    Route::get('/marca',  'index')->name('marca.index');
    Route::post('/marca/create',  'create')->name('marca.create');
    Route::delete('/marca/deletar/{id}',  'destroy')->name('marca.destroy');
    Route::put('/marca/update/{id}',  'update')->name('marca.update');
});

//CATEGORIAS

Route::controller(\App\Http\Controllers\CategoriaController::class)->group(function(){
    Route::get('/categoria',  'index')->name('categoria.index');
    Route::post('/categoria/create',  'create')->name('categoria.create');
    Route::delete('/categoria/deletar/{id}',  'destroy')->name('categoria.destroy');
    Route::put('/categoria/update/{id}',  'update')->name('categoria.update');
});

//PRODUTOS
Route::controller(\App\Http\Controllers\ProdutoController::class)->group(function(){
    Route::get('/produtos',  'index')->name('produtos.index');
    Route::post('/produtos/create',  'create')->name('produtos.create');
    Route::delete('/produtos/deletar/{id}',  'destroy')->name('produtos.destroy');
    Route::put('/produtos/update/{id}',  'update')->name('produtos.update');
});


//MATERIA PRIMA
Route::controller(\App\Http\Controllers\MateriaPrimaController::class)->group(function(){
    Route::get('/materiaprima',  'index')->name('materiaprima.index');
    Route::post('/materiaprima/create',  'create')->name('materiaprima.create');
    Route::delete('/materiaprima/deletar/{id}',  'destroy')->name('materiaprima.destroy');
    Route::put('/materiaprima/update/{id}',  'update')->name('materiaprima.update');
});

//PRODUTOS INGREDIENTESs
Route::controller(\App\Http\Controllers\ProdutosIngredientesController::class)->group(function(){
    Route::get('/produtosingredientes',  'index')->name('produtosingredientes.index');
    Route::post('/produtosingredientes/create',  'create')->name('produtosingredientes.create');
    Route::delete('/produtosingredientes/deletar/{id}',  'destroy')->name('produtosingredientes.destroy');
    Route::put('/produtosingredientes/update/{id}',  'update')->name('produtosingredientes.update');
});

//ÍTENS
Route::controller(\App\Http\Controllers\ItensController::class)->group(function(){
    Route::get('/itens',  'index')->name('itens.index');
    Route::post('/itens/create',  'create')->name('itens.create');
    Route::delete('/itens/deletar/{id}',  'destroy')->name('itens.destroy');
    Route::put('/itens/update/{id}',  'update')->name('itens.update');
});
