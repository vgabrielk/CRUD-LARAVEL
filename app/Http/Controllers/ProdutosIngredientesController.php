<?php

namespace App\Http\Controllers;

use App\Models\ProdutosIngredientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosIngredientesController extends Controller
{
    private $produtos_ingredientes;

    public function __construct(
        ProdutosIngredientes $produtos_ingredientes

    ) {
        $this->produtos_ingredientes = $produtos_ingredientes;
    }

    public function index()
    {
        $produtos_ingredientes = $this->produtos_ingredientes->getProdutosIngredientes();
        return response()->json($produtos_ingredientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $produtos_ingredientes = $this->produtos_ingredientes->add($request->all());
            DB::commit();
            return response()->json([
                'mensagem' => 'Ingredientes cadastrado com sucesso!',
                'nome' => $produtos_ingredientes
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
        $produtos_ingredientes = ProdutosIngredientes::find($id);

        $produtos_ingredientes->quantidade                  = $request->quantidade;
        $produtos_ingredientes->materiaprima_id             = $request->materiaprima_id;
        $produtos_ingredientes->produto_id                  = $request->produto_id;
        $produtos_ingredientes->save();
    }

    public function destroy($id)
    {
        $produtos_ingredientes = ProdutosIngredientes::find($id);
        if($produtos_ingredientes){
            $produtos_ingredientes->delete();
        }
        $produtos_ingredientes->save();
    }
}
