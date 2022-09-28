<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itens extends Model
{


    protected $table = 'itens';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'quantidade',
        'valor_produto',
        'nome_produto',
        'produto_id'
    ];

    public function getItens()
    {
        $itens = Itens::get();
        return $itens;
    }

    public function add($request)
    {

        $itens = $request;
        $itens['quantidade']            = $request['quantidade'];
        $itens['valor_produto']         = $request['valor_produto'];
        $itens['nome_produto']          =  $request['nome_produto'];
        $itens['produto_id']            = $request['produto_id'];
        $this->create($itens);
        return $itens;
    }

    public function editItem($request, $id)
    {
        $itens = Itens::find($id);
        $itens->quantidade          = $request->quantidade;
        $itens->valor_produto       = $request->valor_produto;
        $itens->nome_produto        = $request->nome_produto;
        $itens->produto_id          = $request->produto_id;
        $itens->save();
    }

    public function deleteItem($id)
    {
        $item = Itens::find($id);
        if (!$item) {
            return response()->json(['Ítem não encontrado']);
        }
        $item->delete();
        return response()->json(['Deletado com sucesso!']);
    }
}
