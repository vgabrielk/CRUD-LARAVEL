<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProdutoController extends Controller
{
    private $produtos;

    public function __construct(
        Produto $produtos

    ) {
        $this->produtos = $produtos;
    }
    public function index()
    {
        $data = $this->produtos->getProdutos();
        return response()->json($data);
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $produtos = $this->produtos->add($request->all());
            DB::commit();
            return response()->json([
                'mensagem' => 'Produto cadastrado com sucesso!',
                'nome' => $produtos
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'mensagem' => "Ops, ocorreu algum erro, tente novamente mais tarde!"
            ], 500);
        }
    }

   
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return response()->json([
                "mensagem" => 'Produto não encontrado!'
            ]);
        }
        $produto->nome       = $request->nome;
        $produto->categoria_id       = $request->categoria_id;
        $produto->marca_id       = $request->marca_id;
        $produto->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $produto = Produto::find($id);
            $produto->status = 'EXCLUIDO';
            $produto->data_excluido = date('Y-m-d H:i:s');
            $produto->save();
            return response()->json($produto);
        }
       catch(Throwable $th){
           return response()->json([
               "mensagem" => "Ocorreu um erro, tente novamente mais tarde!", $th
           ]);

       }
    }
}
