<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table      = "marcas";
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = ['nome'];

    public function getMarcas()
    {
        return $this->where('status', '!=', 'EXCLUIDO')->get();
    }

    public function add($request, $usuario )
    {
        $data = $request;
        $data['nome']                  = $request['nome'];
        $data['created_at']            = date('Y-m-d H:i:s');

        $this->create($data);
        return $data;
    }


    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
