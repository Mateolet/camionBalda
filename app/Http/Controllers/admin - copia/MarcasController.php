<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Support\Str;

class MarcasController extends Controller
{
    public function index(Request $request)
    {
        $query = Marca::orderBy('nombre');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('nombre', 'like', '%' . $q . '%')
                    ->orWhere('slug', 'like', '%' . $q . '%');
            });
        }

        return view('admin.marcas.index', [
            'marcas' => $query->get(),
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
