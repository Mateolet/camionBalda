<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModelosController extends Controller
{
    public function index()
    {
        return response()->json(Modelo::orderBy('nombre')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['nombre']);

        $modelo = Modelo::create($data);

        return response()->json($modelo, 201);
    }

    public function show($id)
    {
        return response()->json(Modelo::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $modelo = Modelo::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($data['nombre']);

        $modelo->update($data);

        return response()->json($modelo);
    }

    public function destroy($id)
    {
        Modelo::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
