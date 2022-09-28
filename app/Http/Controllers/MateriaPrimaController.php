<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MateriaPrimaController extends Controller
{
    private $marca;

    public function __construct(
        MateriaPrima $materiaprima

    ) {
        $this->materiaprima = $materiaprima;
    }

    public function index()
    {
        $materiaprima = $this->materiaprima->getMateriaPrimas();
        return response()->json($materiaprima);
    }


    public function create(Request $request)
    {
        $adm = Auth::user();
        try {
            DB::beginTransaction();
            $materiaprima = $this->materiaprima->add($request->all(), $adm);
            DB::commit();
            return response()->json([
                'mensagem' => 'Matéria prima cadastrada com sucesso!',
                'nome' => $materiaprima
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
        $materiaprima = MateriaPrima::find($id);
        if (!$materiaprima) {
            return response()->json([
                "mensagem" => 'Matéria prima não encontrada!'
            ]);
        }
        $materiaprima->quantidade               = $request->quantidade;
        $materiaprima->unidade_medida           = $request->unidade_medida;
        $materiaprima->preco_compra             = $request->preco_compra;
        $materiaprima->fornecedor               = $request->fornecedor;
        $materiaprima->link_fornecedor          = $request->link_fornecedor;
        $materiaprima->save();
        return response()->json([
            'mensagem' => "Atualizada com sucesso!"
        ], 200);
    }


  
    public function destroy($id)
    {
        $materiaprima = MateriaPrima::find($id);
        if (isset($materiaprima)) {
            $materiaprima->delete();
        }
        else {
            return response()->json([
                "mensagem" => "Ocorreu um erro, tente novamente mais tarde!",
            ]);
        }
        return response()->json($materiaprima);
    
    }
}
