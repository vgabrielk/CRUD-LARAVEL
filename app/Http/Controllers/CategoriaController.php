<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    private $categoria;

    public function __construct(
        Categoria $categoria
    ) {
        $this->categoria = $categoria;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->categoria->getCategorias();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $adm = Auth::user();
        try {
            DB::beginTransaction();
            $categoria = $this->categoria->add($request->all(), $adm);
            DB::commit();
            return response()->json([
                'mensagem' => 'Categoria cadastrada com sucesso!',
                'nome' => $categoria
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'mensagem' => "Ops, ocorreu algum erro, tente novamente mais tarde!"
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->nome  =      $request->nome;
        $categoria->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $categoria = Categoria::find($id);
            $categoria->status = 'EXCLUIDO';
            $categoria->data_excluido = date('Y-m-d H:i:s');
            $categoria->save();
            return response()->json([
                "mensagem" => "Excluido com sucesso!"
            ]);
        }
        catch(\Throwable $th){
            return response()->json([
                "mensagem" => "Ocorreu um erro, tente novamente mais tarde!", $th
            ]);
        }
    }
}
