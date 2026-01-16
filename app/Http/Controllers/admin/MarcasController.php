<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Support\Str;

class MarcasController extends Controller
{
    public function index()
    {
        return view('admin.marcas.index', [
            'marcas' => Marca::orderBy('nombre')->get()
        ]);
    }

    public function create()
    {
        return view('admin.marcas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['nombre']);

        Marca::create($data);

        return redirect()
            ->route('admin.marcas.index')
            ->with('success', 'Marca creada correctamente');
    }

    public function edit(Marca $marca)
    {
        return view('admin.marcas.edit', [
            'marca' => $marca
        ]);
    }

    public function update(Request $request, Marca $marca)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $marca->update($data);

        return redirect()
            ->route('admin.marcas.index')
            ->with('success', 'Marca actualizada correctamente');
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();

        return redirect()
            ->route('admin.marcas.index')
            ->with('success', 'Marca eliminada correctamente');
    }
}
