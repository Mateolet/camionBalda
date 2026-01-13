<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // GET /api/clientes
    public function index()
    {
        return response()->json(
            Cliente::all()
        );
    }

    // POST /api/clientes
    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());

        return response()->json($cliente, 201);
    }

    // GET /api/clientes/{id}
    public function show($id)
    {
        return response()->json(
            Cliente::findOrFail($id)
        );
    }

    // PUT /api/clientes/{id}
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return response()->json($cliente);
    }

    // DELETE /api/clientes/{id}
    public function destroy($id)
    {
        Cliente::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
