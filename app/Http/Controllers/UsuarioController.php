<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Throwable;

class UsuarioController extends Controller
{
    private $usuario;

    public function __construct(
        Usuario $usuario

    ) {
        $this->usuario = $usuario;
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $usuario = $this->usuario->add($request->all());
            DB::commit();
            return response()->json([
                'mensagem' => 'Usuário cadastrado com sucesso!',
                'name' => $usuario
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json([
                'mensagem' => "Ops, ocorreu algum erro, tente novamente mais tarde!"
            ], 500);
        }
    }


    public function index(Request $request)
    {
        $data['usuarios'] = $this->usuario->getUsuariosAtivos($request);
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
       
        $usuario->nome                  = $request->nome;
        $usuario->email                 = $request->email;
        $usuario->senha                 = $request->senha;
        $usuario->usuario_idtipo        = $request->usuario_idtipo;
        $usuario->data_adicionado       =  date('Y-m-d H:i:s');
        $usuario->data_excluido         =  date('Y-m-d H:i:s');
        $usuario->save();
    }

    public function destroy($id)
    {
        try{
            $usuario = Usuario::find($id);
            $usuario->status = 'EXCLUIDO';
            $usuario->data_excluido = date('Y-m-d H:i:s');
            $usuario->save();
            return response()->json($usuario);
        }
        catch(Throwable $th){
            return response()->json([
                "mensagem" => "Ocorreu um erro, tente novamente mais tarde!", $th
            ]);
        }
    }
}
