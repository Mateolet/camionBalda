<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Referencia;

class ReferenciasController extends Controller
{
    private array $imageFields = ['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5'];

    public function index()
    {
        return Referencia::latest()
            ->get()
            ->map(fn (Referencia $referencia) => $this->formatReferencia($referencia));
    }

    public function show(Referencia $referencia)
    {
        return $this->formatReferencia($referencia);
    }

    private function formatReferencia(Referencia $referencia): array
    {
        $imagenes = collect($this->imageFields)
            ->map(fn (string $field) => $referencia->{$field})
            ->filter()
            ->map(fn (string $path) => asset('storage/' . $path))
            ->values();

        return [
            'id' => $referencia->id,
            'publicacion' => $referencia->publicacion,
            'descripcion' => $referencia->descripcion,
            'imagenes' => $imagenes,
            'created_at' => optional($referencia->created_at)->toISOString(),
            'updated_at' => optional($referencia->updated_at)->toISOString(),
        ];
    }
}
