<?php

namespace App\Http\Controllers;

use App\Models\Itens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItensController extends Controller
{

    private $itens;

    public function __construct(Itens $itens)
    {
        $this->itens = $itens;
    }

    public function index()
    {
        $data = $this->itens->getItens();
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data = $this->itens->add($request->all());
        return $data;
    }


    public function update(Request $request, $id)
    {
        $itens = $this->itens->editItem($request, $id);
        return $itens;
    }


    public function destroy($id)
    {
        $item = $this->itens->deleteItem($id);
        return $item;
    }
}
