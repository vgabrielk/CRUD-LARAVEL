<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Produtos;

class ProdutosIngredientes extends Model
{
    protected $table      = 'produtos_ingredientes';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'materiaprima_id',
        'quantidade',
        'produto_id'
    ];

    public function add($request){
        $data = $request;
        $data['quantidade']                   = $request['quantidade'];
        $data['produto_id']                   = $request['produto_id'];
        $data['materiaprima_id']              = $request['materiaprima_id'];
        $this->create($data);
        return $data;
    }
    public function getProdutosIngredientes()
    {
        $produtos_ingredientes = ProdutosIngredientes::with(['materiaprima', 'produto'])->get();
        return $produtos_ingredientes;
    }

    public function materiaprima()
    {
        return $this->belongsTo(MateriaPrima::class, 'materiaprima_id');
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
