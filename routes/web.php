<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CamionesController;
use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\MarcasController;
use App\Http\Controllers\Admin\ModelosController;
use App\Http\Controllers\Admin\ReferenciasController;
use App\Models\Referencia;
Route::get('/', function () {
    try {
        $referencias = Referencia::latest()->get();
    } catch (\Throwable $exception) {
        report($exception);
        $referencias = collect();
    }

    return view('welcome', [
        'referencias' => $referencias,
    ]);
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
    Route::resource('modelos', ModelosController::class);
    Route::resource('referencias', ReferenciasController::class)->except('show');
});
