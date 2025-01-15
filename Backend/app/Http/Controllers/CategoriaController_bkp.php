<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Seeder;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $timestamps = false;
    public function index()
    {

        $categorias = Categoria::all();

        if ($categorias->isEmpty()) {
            return response()->json(['message' => 'Nenhuma categoria encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($categorias);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
        ]);


        $categoria = Categoria::create([
            'nome' => $request->nome,
        ]);

        return response()->json($categoria, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($categoria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $categoria->update([
            'nome' => $request->nome,
        ]);

        return response()->json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada'], Response::HTTP_NOT_FOUND);
        }

        $categoria->delete();

        return response()->json(['message' => 'Categoria deletada com sucesso'], Response::HTTP_OK);
    }
}