<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioTipo extends Model
{
    protected $table      = "usuarios_tipos";
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = ['name'];

    public function getUsuarios()
    {
        return $this->where('name', '!=', '')->get();
    }

    public function add($request, $usuario )
    {
        $data = $request;
        $data['name']                  = $request['name'];
        $data['data_adicionado']       = date('Y-m-d H:i:s');
        $data['data_excluido']         = date('Y-m-d H:i:s');

        $this->create($data);
        return $data;
    }

    public function usuarios(){
        return $this->belongsTo(Usuario::class);
    }
}
