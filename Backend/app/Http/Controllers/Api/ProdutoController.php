<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    // Método para listar produtos com categoria associada
    public function index()
    {
        $produtos = Produto::with('categoria')->get();  // Carregar categoria associada
        return response()->json($produtos);
    }

    // Método para criar um novo produto
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'categoria_id' => 'required|integer|exists:categorias,id',  // Alterado para categoria_id
            'preco' => 'required|numeric|min:0',
            'data_validade' => 'required|date',
            'imagem' => 'required|string',  // A imagem pode ser uma URL ou o caminho do arquivo
        ]);
    

        $produto = Produto::create($validated);
    
        return response()->json($produto, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'string|max:255',
            'descricao' => 'string',
            'categoria_id' => 'integer|exists:categorias,id',
            'preco' => 'numeric|min:0',
            'data_validade' => 'date',
            'imagem' => 'string',
        ]);

        $produto = Produto::findOrFail($id);

        $produto->update($validated);
    
        return response()->json($produto);
    }

    public function categories()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }
}
