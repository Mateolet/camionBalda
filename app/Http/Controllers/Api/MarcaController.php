<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marca;   // 👈 ESTO ES CLAVE
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        return response()->json(Marca::all());
    }

    public function store(Request $request)
    {
        $marca = Marca::create($request->all());
        return response()->json($marca, 201);
    }

    public function show($id)
    {
        return response()->json(Marca::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->update($request->all());
        return response()->json($marca);
    }

    public function destroy($id)
    {
        Marca::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

