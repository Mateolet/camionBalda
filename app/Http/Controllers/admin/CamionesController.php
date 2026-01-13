<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Camiones;
use App\Models\Marca;
use App\Models\Categoria;

class CamionesController extends Controller
{
    public function index()
    {
        $camiones = Camiones::with(['marca','categoria'])
            ->orderByDesc('id')
            ->get();

        return view('admin.camiones.index', [
            'camiones' => $camiones
        ]);
    }

    public function create()
    {
        return view('admin.camiones.create', [
            'marcas'     => Marca::orderBy('nombre')->get(),
            'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }

public function store(Request $request)
{
    $data = $request->validate([
        'categoria_id'       => 'required|integer',
        'marca_id'           => 'required|integer',
        'modelo_id'          => 'nullable|integer',
        'medida'             => 'nullable|string|max:50',
        'anio'               => 'required|integer',
        'precio'             => 'required|numeric',
        'kilometros'         => 'nullable|integer',
        'ubicacion'          => 'nullable|string|max:255',
        'condicion'          => 'nullable|string|max:50',
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

    // fallback seguro
    $data['modelo_id'] = $data['modelo_id'] ?? 1;

    Camiones::create($data);

    return redirect()
        ->route('admin.camiones.index')
        ->with('success', 'Camión creado correctamente');
}

    public function edit(Camiones $camion)
    {
        return view('admin.camiones.edit', [
            'camion'     => $camion,
            'marcas'     => Marca::orderBy('nombre')->get(),
            'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }

public function update(Request $request, Camiones $camion)
{
    $data = $request->validate([
        'categoria_id'       => 'required|integer',
        'marca_id'           => 'required|integer',
        'modelo_id'          => 'nullable|integer',
        'medida'             => 'nullable|string|max:50',
        'anio'               => 'required|integer',
        'precio'             => 'required|numeric',
        'kilometros'         => 'nullable|integer',
        'ubicacion'          => 'nullable|string|max:255',
        'condicion'          => 'nullable|string|max:50',
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

    $data['modelo_id'] = $data['modelo_id'] ?? 1;

    $camion->update($data);

    return redirect()
        ->route('admin.camiones.index')
        ->with('success', 'Camión actualizado correctamente');
}

    public function destroy(Camiones $camion)
    {
        $camion->delete();
        return redirect()->route('admin.camiones.index');
    }
}
