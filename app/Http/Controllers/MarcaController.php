<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Marca;
use Throwable;

class MarcaController extends Controller
{
    private $marca;

    public function __construct(
        Marca $marca

    ) {
        $this->marca = $marca;
    }

    public function create(Request $request)
    {
        $adm = Auth::user();
        try {
            DB::beginTransaction();
            $marca = $this->marca->add($request->all(), $adm);
            DB::commit();
            return response()->json([
                'mensagem' => 'Marca cadastrada com sucesso!',
                'nome' => $marca
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'mensagem' => "Ops, ocorreu algum erro, tente novamente mais tarde!"
            ], 500);
        }
    }


    public function index()
    {
        $data = $this->marca->getMarcas();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);
        if (!$marca) {
            return response()->json([
                "mensagem" => 'Marca não encontrada!'
            ]);
        }
        $marca->nome       = $request->nome;
        $marca->save();
    }

    public function destroy($id)
    {
        try{
            $marca = Marca::find($id);
            $marca->status = 'EXCLUIDO';
            $marca->data_excluido = date('Y-m-d H:i:s');
            $marca->save();
            return response()->json($marca);
        }
       catch(Throwable $th){
           return response()->json([
               "mensagem" => "Ocorreu um erro, tente novamente mais tarde!", $th
           ]);

       }
    }
}
