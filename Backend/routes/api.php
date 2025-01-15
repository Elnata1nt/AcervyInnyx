<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('produtos', ProdutoController::class);
    Route::apiResource('categorias', CategoriaController::class);
});

// Rotas adicionais (se necessário)
Route::get('produtos/categorias', [ProdutoController::class, 'categories']);

Route::put('/produtos/{id}', [ProdutoController::class, 'update']);
