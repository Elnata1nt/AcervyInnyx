<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Lista todos os produtos com suas categorias associadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::with('categoria')->get();
        return response()->json($produtos);
    }

    /**
     * Retorna todas as categorias disponíveis.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    /**
     * Armazena um novo produto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categorias,id',
            'price' => 'required|numeric|min:0',
            'expiryDate' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Criação do produto
        $produto = Produto::create([
            'nome' => $request->input('name'),
            'descricao' => $request->input('description'),
            'categoria_id' => $request->input('category'),
            'preco' => $request->input('price'),
            'data_validade' => $request->input('expiryDate'),
        ]);

        return response()->json($produto, 201);
    }

    /**
     * Atualiza os dados de um produto existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categorias,id',
            'price' => 'required|numeric|min:0',
            'expiryDate' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $produto->update([
            'nome' => $request->input('name'),
            'descricao' => $request->input('description'),
            'categoria_id' => $request->input('category'),
            'preco' => $request->input('price'),
            'data_validade' => $request->input('expiryDate'),
        ]);

        return response()->json($produto, 200);
    }

    /**
     * Remove um produto específico.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json(['message' => 'Produto excluído com sucesso'], 200);
    }
}
