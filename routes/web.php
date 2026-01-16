<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CamionesController;
use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\MarcasController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-web', function () {
    return 'web ok';
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('camiones', CamionesController::class)
        ->parameters(['camiones' => 'camion']);
    Route::delete('camiones/{camion}/imagenes/{imagen}', [CamionesController::class, 'destroyImagen'])
        ->name('camiones.imagenes.destroy');

    Route::resource('categorias', CategoriasController::class);
    Route::resource('marcas', MarcasController::class);
});
