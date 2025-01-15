<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

// Redirecionar a raiz para o sistema
Route::get('/', function () {
    return redirect('http://localhost:5173/#/System');
});

// Dashboard (apenas usuários autenticados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rotas de Autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rotas de Recursos para o Sistema
Route::resource('produtos', ProdutoController::class)->except(['create', 'edit']);
Route::resource('categorias', CategoriaController::class)->except(['create', 'edit']);

// API Routes (Grupo com Prefixo API)
Route::prefix('api')->group(function () {
    Route::apiResource('produtos', ProdutoController::class);
    Route::apiResource('categorias', CategoriaController::class)->only(['index', 'store']);
});
