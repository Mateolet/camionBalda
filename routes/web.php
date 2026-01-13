<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CamionesController;
use App\Http\Controllers\Admin\CategoriasController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-web', function () {
    return 'web ok';
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('camiones', CamionesController::class)
        ->parameters(['camiones' => 'camion']);

    Route::resource('categorias', CategoriasController::class);
});
