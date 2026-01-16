<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Camiones;
use App\Models\Marca;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class CamionesController extends Controller
{
    public function index()
    {
        $camiones = Camiones::with(['marca','categoria','imagenes'])
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
        'imagenes'           => 'nullable|array',
        'imagenes.*'         => 'image|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    // fallback seguro
    $data['modelo_id'] = $data['modelo_id'] ?? 1;

    $camion = Camiones::create($data);

    if ($request->hasFile('imagenes')) {
        $posicion = 1;

        foreach ($request->file('imagenes') as $imagen) {
            if (!$imagen->isValid()) {
                continue;
            }

            $path = $imagen->store('camiones', 'public');

            $camion->imagenes()->create([
                'url' => $path,
                'posicion' => $posicion++,
            ]);
        }
    }

    return redirect()
        ->route('admin.camiones.index')
        ->with('success', 'Camión creado correctamente');
}

    public function edit(Camiones $camion)
    {
        $camion->load('imagenes');

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
        'imagenes'           => 'nullable|array',
        'imagenes.*'         => 'image|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    $data['modelo_id'] = $data['modelo_id'] ?? 1;

    $camion->update($data);

    if ($request->hasFile('imagenes')) {
        $posicion = ($camion->imagenes()->max('posicion') ?? 0) + 1;

        foreach ($request->file('imagenes') as $imagen) {
            if (!$imagen->isValid()) {
                continue;
            }

            $path = $imagen->store('camiones', 'public');

            $camion->imagenes()->create([
                'url' => $path,
                'posicion' => $posicion++,
            ]);
        }
    }

    return redirect()
        ->route('admin.camiones.index')
        ->with('success', 'Camión actualizado correctamente');
}

    public function destroy(Camiones $camion)
    {
        $camion->delete();
        return redirect()->route('admin.camiones.index');
    }

    public function destroyImagen(Camiones $camion, $imagen)
    {
        $imagen = $camion->imagenes()->findOrFail($imagen);

        if (!empty($imagen->url)) {
            Storage::disk('public')->delete($imagen->url);
        }

        $imagen->delete();

        return back()->with('success', 'Imagen eliminada correctamente');
    }
}
