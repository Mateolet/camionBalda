<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriasController extends Controller
{
    public function index()
    {
        return view('admin.categorias.index', [
            'categorias' => Categoria::orderBy('orden')->get()
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
