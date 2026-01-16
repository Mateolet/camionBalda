<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Camiones;

class CamionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camiones = Camiones::with([
            'marca:id,nombre',
            'categoria:id,nombre',
            'imagenes:id,camion_id,url,posicion',
            // 'modelo:id,nombre'
        ])->get();

        return $camiones->map(function ($camion) {
            $camion->imagenes->transform(function ($imagen) {
                $imagen->url = asset('storage/' . $imagen->url);
                return $imagen;
            });

            $camion->imagen_principal_url = $camion->imagen_principal
                ? asset('storage/' . $camion->imagen_principal)
                : null;

            return $camion;
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'categoria_id'       => 'required|integer',
            'marca_id'           => 'required|integer',
            // 'modelo_id'          => 'required|integer',
            'medida'             => 'nullable|string|max:50',
            'anio'               => 'required|integer',
            'precio'             => 'required|numeric',
            'kilometros'         => 'nullable|integer',
            'ubicacion'          => 'nullable|string|max:255',
            'condicion'          => 'required|string|max:50',
            'combustible'        => 'nullable|string|max:50',
            'transmision'        => 'nullable|string|max:50',
            'motor'              => 'nullable|string|max:100',
            'transmision_detalle'=> 'nullable|string|max:100',
            'ejes'               => 'nullable|string|max:50',
            'suspension'         => 'nullable|string|max:100',
            'cabina'             => 'nullable|string|max:100',
            'peso_bruto'         => 'nullable|numeric',
            'distancia_ejes'     => 'nullable|numeric',
            'capacidad_tanque'   => 'nullable|numeric',
            'equipamiento'       => 'nullable|string',
            'vendedor_id'        => 'nullable|integer',
            'imagen_principal'   => 'nullable|string|max:255',
            'descripcion'        => 'nullable|string',
            'estado'             => 'required|string|max:50',
        ]);

        $camion = Camiones::create($data);

        return response()->json($camion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $camion = Camiones::with([
            'marca:id,nombre',
            'categoria:id,nombre',
            'imagenes:id,camion_id,url,posicion',
            // 'modelo:id,nombre'
        ])->findOrFail($id);

        $camion->imagenes->transform(function ($imagen) {
            $imagen->url = asset('storage/' . $imagen->url);
            return $imagen;
        });

        $camion->imagen_principal_url = $camion->imagen_principal
            ? asset('storage/' . $camion->imagen_principal)
            : null;

        return $camion;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $camion = Camiones::findOrFail($id);

        $data = $request->validate([
            'categoria_id'       => 'sometimes|integer',
            'marca_id'           => 'sometimes|integer',
            // 'modelo_id'          => 'sometimes|integer',
            'medida'             => 'nullable|string|max:50',
            'anio'               => 'sometimes|integer',
            'precio'             => 'sometimes|numeric',
            'kilometros'         => 'nullable|integer',
            'ubicacion'          => 'nullable|string|max:255',
            'condicion'          => 'sometimes|string|max:50',
            'combustible'        => 'nullable|string|max:50',
            'transmision'        => 'nullable|string|max:50',
            'motor'              => 'nullable|string|max:100',
            'transmision_detalle'=> 'nullable|string|max:100',
            'ejes'               => 'nullable|string|max:50',
            'suspension'         => 'nullable|string|max:100',
            'cabina'             => 'nullable|string|max:100',
            'peso_bruto'         => 'nullable|numeric',
            'distancia_ejes'     => 'nullable|numeric',
            'capacidad_tanque'   => 'nullable|numeric',
            'equipamiento'       => 'nullable|string',
            'vendedor_id'        => 'nullable|integer',
            'imagen_principal'   => 'nullable|string|max:255',
            'descripcion'        => 'nullable|string',
            'estado'             => 'sometimes|string|max:50',
        ]);

        $camion->update($data);

        return response()->json($camion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $camion = Camiones::findOrFail($id);
        $camion->delete();

        return response()->json([
            'message' => 'Camión eliminado correctamente'
        ]);
    }
}
