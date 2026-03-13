<?php

use App\Http\Controllers\Api\CamionesController;
use App\Http\Controllers\Api\CategoriasController;
use App\Http\Controllers\Api\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\ModelosController;
use App\Http\Controllers\Api\ContactoController;


Route::apiResource('clientes', ClienteController::class);

Route::apiResource('marcas', MarcaController::class);
Route::apiResource('modelos', ModelosController::class);

Route::apiResource('camiones', CamionesController::class);


Route::apiResource('categorias', CategoriasController::class);

Route::post('contacto', [ContactoController::class, 'store']);
