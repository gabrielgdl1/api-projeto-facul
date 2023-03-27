<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\CarroController;
use App\Http\Controllers\Api\AnuncioController;
use App\Http\Controllers\Api\CarroItemController;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\UsuarioController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('itens', [ItemController::class, 'index']);
Route::get('itens/{id}', [ItemController::class, 'show']);
Route::post('itens', [ItemController::class, 'create']);
Route::put('itens/{id}/editar', [ItemController::class, 'update']);
Route::delete('itens/{id}/excluir', [ItemController::class, 'delete']);

Route::get('carros', [CarroController::class, 'index']);
Route::get('carros/{id}', [CarroController::class, 'show']);
Route::post('carros', [CarroController::class, 'create']);
Route::put('carros/{id}/editar', [CarroController::class, 'update']);
Route::delete('carros/{id}/excluir', [CarroController::class, 'delete']);

Route::get('anuncios', [AnuncioController::class, 'index']);
Route::get('anuncios/{id}', [AnuncioController::class, 'show']);
Route::post('anuncios', [AnuncioController::class, 'create']);
Route::put('anuncios/{id}/editar', [AnuncioController::class, 'update']);
Route::delete('anuncios/{id}/excluir', [AnuncioController::class, 'delete']);

Route::get('carrosItens', [CarroItemController::class, 'index']);
Route::get('carrosItens/{id}', [CarroItemController::class, 'show']);
Route::post('carrosItens', [CarroItemController::class, 'create']);
Route::put('carrosItens/{id}/editar', [CarroItemController::class, 'update']);
Route::delete('carrosItens/{id}/excluir', [CarroItemController::class, 'delete']);

Route::get('marcas', [MarcaController::class, 'index']);
Route::get('marcas/{id}', [MarcaController::class, 'show']);
Route::post('marcas', [MarcaController::class, 'create']);
Route::put('marcas/{id}/editar', [MarcaController::class, 'update']);
Route::delete('marcas/{id}/excluir', [MarcaController::class, 'delete']);

Route::get('usuarios', [UsuarioController::class, 'index']);
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('usuarios', [UsuarioController::class, 'create']);
Route::put('usuarios/{id}/editar', [UsuarioController::class, 'update']);
Route::delete('usuarios/{id}/excluir', [UsuarioController::class, 'delete']);
