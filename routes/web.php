<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::view('/registo', 'registo');
    Route::post('/registo', [AuthController::class, 'registo']);
    Route::view('/entrar', 'entrar')->name('login');
    Route::post('/entrar', [AuthController::class, 'entrar']);
});

Route::middleware('auth')->group(function () {
    Route::get('/painel', [AnuncioController::class, 'painel']);
    Route::view('/anuncios/novo', 'novo');
    Route::post('/anuncios', [AnuncioController::class, 'store']);
    Route::post('/anuncios/{anuncio}/estado', [AnuncioController::class, 'estado']);
    Route::delete('/anuncios/{anuncio}', [AnuncioController::class, 'destroy']);
    Route::post('/sair', [AuthController::class, 'sair']);
});

Route::middleware('auth')->group(function () {
    Route::get('/anuncios/{anuncio}/editar', [\App\Http\Controllers\EditarAnuncioController::class, 'form']);
    Route::put('/anuncios/{anuncio}', [\App\Http\Controllers\EditarAnuncioController::class, 'guardar']);
});

Route::get('/', [\App\Http\Controllers\PesquisaController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::post('/anuncios/{anuncio}/renovar', \App\Http\Controllers\RenovarController::class);
});

Route::view('/esqueci', 'esqueci');
Route::get('/nova-senha/{token}', [\App\Http\Controllers\RecuperarSenhaController::class, 'form']);
Route::post('/nova-senha', [\App\Http\Controllers\RecuperarSenhaController::class, 'guardar']);

Route::view('/termos', 'termos');
Route::view('/privacidade', 'privacidade');

Route::middleware(['auth', \App\Http\Middleware\SoAdmin::class])->prefix('admin')->group(function () {
    $c = \App\Http\Controllers\AdminController::class;
    Route::get('/', [$c, 'inicio']);
    Route::get('/anuncios', [$c, 'anuncios']);
    Route::post('/anuncios/{id}/estado', [$c, 'anuncioEstado']);
    Route::delete('/anuncios/{id}', [$c, 'anuncioApagar']);
    Route::get('/utilizadores', [$c, 'utilizadores']);
    Route::post('/utilizadores/{id}/selo', [$c, 'selo']);
    Route::post('/utilizadores/{id}/bloquear', [$c, 'bloquear']);
    Route::post('/utilizadores/{id}/senha', [$c, 'linkSenha']);
});

Route::get('/anuncio/{anuncio}', [\App\Http\Controllers\AnuncioController::class, 'show'])->middleware(\App\Http\Middleware\ContarVisita::class);
Route::get('/anuncio/{anuncio}/whatsapp', \App\Http\Controllers\ContactarController::class);
Route::get('/anuncios/{anuncio}/estatisticas', \App\Http\Controllers\EstatisticaController::class)->middleware('auth');
