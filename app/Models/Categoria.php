<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table      = "categorias";
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable = ['nome'];

    public function getCategorias()
    {
        return $this->where('status', '!=', 'EXCLUIDO')->get();
    }
    public function add($request)
    {
        $data = $request;
        $data['nome']                  = $request['nome'];
        $data['data_adicionado']       = date('Y-m-d H:i:s');

        $this->create($data);
        return $data;
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
