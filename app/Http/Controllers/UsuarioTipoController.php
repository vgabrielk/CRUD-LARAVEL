<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UsuarioTipo;

class UsuarioTipoController extends Controller
{
    private $usuarioTipo;

    public function __construct(
        UsuarioTipo $usuarioTipo

    ) {
        $this->usuarioTipo = $usuarioTipo;
    }

    public function create(Request $request)
    {
        $adm = Auth::user();
        try {
            DB::beginTransaction();
            $usuarioTipo = $this->usuarioTipo->add($request->all(), $adm);
            DB::commit();
            return response()->json([
                'mensagem' => 'Tipo cadastrado com sucesso!',
                'name' => $usuarioTipo
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
        $data = $this->usuarioTipo->getUsuarios();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $usuario = UsuarioTipo::find($id);
        if (!$usuario) {
            return response()->json([
                "mensagem" => 'Tipo não encontrado!'
            ]);
        }
        $usuario->name       = $request->name;
        $usuario->save();
    }

    public function destroy($id)
    {
        $usuario = UsuarioTipo::find($id);
        if (isset($usuario)) {
            $usuario->delete();
        }
        else {
            return response()->json([
                "mensagem" => "Ocorreu um erro, tente novamente mais tarde!",
            ]);
        }
        return response()->json($usuario);
    }
}
