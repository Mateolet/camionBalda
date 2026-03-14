<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        $query = Categoria::orderBy('orden');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('nombre', 'like', '%' . $q . '%')
                    ->orWhere('slug', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('visible')) {
            $query->where('visible', (int) $request->input('visible'));
        }

        return view('admin.categorias.index', [
            'categorias' => $query->get(),
        ]);
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required',
            'descripcion' => 'nullable',
            'visible'     => 'required|boolean',
            'orden'       => 'nullable|integer',
        ]);

        $data['slug'] = Str::slug($data['nombre']);

        Categoria::create($data);

        return redirect()->route('admin.categorias.index');
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', [
            'categoria' => $categoria
        ]);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre'      => 'required',
            'descripcion' => 'nullable',
            'visible'     => 'required|boolean',
            'orden'       => 'nullable|integer',
        ]);

        $categoria->update($data);

        return redirect()->route('admin.categorias.index');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('admin.categorias.index');
    }
}
