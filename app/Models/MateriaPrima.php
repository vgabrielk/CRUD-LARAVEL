<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    protected $table      = "materiaprima";
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = ['quantidade', 'unidade_medida', 'preco_compra', 'fornecedor', 'link_fornecedor'];


    public function getMateriaPrimas()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function add($request)
    {
        $data = $request;
        $data['quantidade']                   = $request['quantidade'];
        $data['unidade_medida']               = $request['unidade_medida'];
        $data['preco_compra']                 = $request['preco_compra'];
        $data['fornecedor']                   = $request['fornecedor'];
        $data['link_fornecedor']              = $request['link_fornecedor'];
        $this->create($data);
        return $data;
    }

    public function produtosingredientes(){
        $produtos = MateriaPrima::belongsTo(ProdutosIngredientes::class, 'materiaprima_id');
    }

}
