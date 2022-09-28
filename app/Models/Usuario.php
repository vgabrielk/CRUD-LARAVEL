<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table      = "usuarios";
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'status',
        'usuario_idtipo'
    ];

    public function getUsuariosAtivos()
    {
        return $this->where('status', 'ATIVO')->get();
    }

    public function add($request)
    {
        $data = $request;
        $data['nome']                   = $request['nome'];
        $data['email']                  = $request['email'];
        $data['senha']                  = $request['senha'];
        $data['usuario_idtipo']         = $request['usuario_idtipo'];
        $data['status']                 = 'ATIVO';
        $data['data_adicionado']        = date('Y-m-d H:i:s');
        $data['data_excluido']          = date('Y-m-d H:i:s');

        $this->create($data);
        return $data;
    }
    public function usuariosTipos(){
        return $this->hasMany(UsuarioTipo::class);
    }
}
