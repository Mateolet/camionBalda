<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categoria::orderBy('orden')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:150',
            'slug'        => 'nullable|string|max:150|unique:categorias,slug',
            'descripcion' => 'nullable|string',
            'visible'     => 'required|boolean',
            'orden'       => 'nullable|integer',
        ]);

        // Si no mandan slug, lo generamos
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['nombre']);
        }

        $categoria = Categoria::create($data);

        return response()->json($categoria, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Categoria::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $data = $request->validate([
            'nombre'      => 'sometimes|string|max:150',
            'slug'        => 'sometimes|string|max:150|unique:categorias,slug,' . $categoria->id,
            'descripcion' => 'nullable|string',
            'visible'     => 'sometimes|boolean',
            'orden'       => 'nullable|integer',
        ]);

        // Regenerar slug si cambia el nombre y no mandan slug
        if (
            isset($data['nombre']) &&
            empty($data['slug'])
        ) {
            $data['slug'] = Str::slug($data['nombre']);
        }

        $categoria->update($data);

        return response()->json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ]);
    }
}
