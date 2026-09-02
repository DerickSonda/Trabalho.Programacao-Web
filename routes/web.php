<?php

use App\Http\Controllers\FilmeController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

// ---------- Parte pública (galeria de filmes) ----------
Route::get('/', [GaleriaController::class, 'index'])->name('galeria.index');
Route::get('/filme/{filme}', [GaleriaController::class, 'show'])->name('galeria.show');

// ---------- Login ----------
// O nome "login" é importante: o Laravel usa esse nome para mandar
// para cá quem tentar abrir a administração sem estar logado.
Route::get('/entrar', [LoginController::class, 'mostrarFormulario'])->name('login');
Route::post('/entrar', [LoginController::class, 'entrar'])->name('entrar');
Route::post('/sair', [LoginController::class, 'sair'])->name('sair');

// ---------- Cadastro de usuário ----------
Route::get('/registrar', [RegistroController::class, 'mostrarFormulario'])->name('registro');
Route::post('/registrar', [RegistroController::class, 'registrar'])->name('registrar');

// ---------- Administração (só entra quem está logado) ----------
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/filmes', [FilmeController::class, 'index'])->name('filmes.index');

    Route::get('/filmes/criar', [FilmeController::class, 'create'])->name('filmes.create');
    Route::post('/filmes', [FilmeController::class, 'store'])->name('filmes.store');

    Route::get('/filmes/{filme}/editar', [FilmeController::class, 'edit'])->name('filmes.edit');
    Route::put('/filmes/{filme}', [FilmeController::class, 'update'])->name('filmes.update');

    Route::get('/filmes/{filme}/excluir', [FilmeController::class, 'delete'])->name('filmes.delete');
    Route::delete('/filmes/{filme}', [FilmeController::class, 'destroy'])->name('filmes.destroy');
});
