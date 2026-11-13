<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/anuncio/{anuncio}', [AnuncioController::class, 'show']);

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
