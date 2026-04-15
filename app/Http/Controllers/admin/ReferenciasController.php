<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReferenciasController extends Controller
{
    private array $imageFields = ['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5'];

    public function index()
    {
        return view('admin.referencias.index', [
            'referencias' => Referencia::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.referencias.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        foreach ($this->imageFields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('referencias', 'public');
            }
        }

        Referencia::create($data);

        return redirect()
            ->route('admin.referencias.index')
            ->with('success', 'Referencia creada correctamente');
    }

    public function edit(Referencia $referencia)
    {
        return view('admin.referencias.edit', [
            'referencia' => $referencia,
        ]);
    }

    public function update(Request $request, Referencia $referencia)
    {
        $data = $this->validateData($request);

        foreach ($this->imageFields as $field) {
            if ($request->boolean('eliminar_' . $field) && $referencia->{$field}) {
                Storage::disk('public')->delete($referencia->{$field});
                $data[$field] = null;
            }

            if ($request->hasFile($field)) {
                if ($referencia->{$field}) {
                    Storage::disk('public')->delete($referencia->{$field});
                }

                $data[$field] = $request->file($field)->store('referencias', 'public');
            }
        }

        $referencia->update($data);

        return redirect()
            ->route('admin.referencias.index')
            ->with('success', 'Referencia actualizada correctamente');
    }

    public function destroy(Referencia $referencia)
    {
        foreach ($this->imageFields as $field) {
            if ($referencia->{$field}) {
                Storage::disk('public')->delete($referencia->{$field});
            }
        }

        $referencia->delete();

        return redirect()
            ->route('admin.referencias.index')
            ->with('success', 'Referencia eliminada correctamente');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'publicacion' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'imagen1' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'imagen2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'imagen3' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'imagen4' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'imagen5' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);
    }
}
