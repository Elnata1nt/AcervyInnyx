<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:50',
            'descricao' => 'required|max:200',
            'preco' => 'required|numeric',
            'data_validade' => 'required|date',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $produto = Produto::create($validated);

        if ($request->hasFile('imagem')) {
            $produto->imagem = $request->file('imagem')->store('produtos', 'public');
            $produto->save();
        }

        return response()->json($produto, 201);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|max:50',
            'descricao' => 'required|max:200',
            'preco' => 'required|numeric',
            'data_validade' => 'required|date',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $produto->update($validated);

        if ($request->hasFile('imagem')) {
            $produto->imagem = $request->file('imagem')->store('produtos', 'public');
            $produto->save();
        }

        return response()->json($produto);
    }
}
