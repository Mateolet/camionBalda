<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModelosController extends Controller
{
    public function index()
    {
        return view('admin.modelos.index', [
            'modelos' => Modelo::with('marca')->orderBy('nombre')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.modelos.create', [
            'marcas' => Marca::orderBy('nombre')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'marca_id' => 'required|integer',
            'nombre' => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['nombre']);

        Modelo::create($data);

        return redirect()
            ->route('admin.modelos.index')
            ->with('success', 'Modelo creado correctamente');
    }

    public function edit(Modelo $modelo)
    {
        return view('admin.modelos.edit', [
            'modelo' => $modelo,
            'marcas' => Marca::orderBy('nombre')->get(),
        ]);
    }

    public function update(Request $request, Modelo $modelo)
    {
        $data = $request->validate([
            'marca_id' => 'required|integer',
            'nombre' => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['nombre']);

        $modelo->update($data);

        return redirect()
            ->route('admin.modelos.index')
            ->with('success', 'Modelo actualizado correctamente');
    }

    public function destroy(Modelo $modelo)
    {
        $modelo->delete();

        return redirect()
            ->route('admin.modelos.index')
            ->with('success', 'Modelo eliminado correctamente');
    }
}
