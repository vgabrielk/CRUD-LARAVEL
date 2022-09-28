<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table      = 'produtos';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'nome',
        'categoria_id',
        'marca_id'
    ];

    public function getProdutos()
    {
        $produtos = Produto::with(['categoria', 'marca'])->where('status', 'ATIVO')->get();
        return $produtos;
    }

    public function add($request){
        $data = $request;
        $data['nome']                   = $request['nome'];
        $data['categoria_id']           = $request['categoria_id'];
        $data['marca_id']               = $request['marca_id'];
        $this->create($data);
        return $data;
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'id');
    }   

    public function produtosingredientes(){
        $produtos = $this->belongsTo(ProdutosIngredientes::class, 'produto_id');
    }


}
