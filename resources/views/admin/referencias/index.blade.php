@extends('layouts.admin')

@section('title', 'Referencias')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Referencia</h3>
        <small class="text-muted">Imagenes de referencia por publicacion</small>
    </div>

    <a href="{{ route('admin.referencias.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nueva referencia
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Publicacion</th>
                    <th>Descripcion</th>
                    <th>Imagenes</th>
                    <th>Creada</th>
                    <th class="text-end"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($referencias as $referencia)
                    <tr>
                        <td class="fw-bold">#{{ $referencia->id }}</td>
                        <td>{{ $referencia->publicacion }}</td>
                        <td>{{ Str::limit($referencia->descripcion, 80) ?: '-' }}</td>
                        <td>
                            @php($imagenes = collect(['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5'])->map(fn($field) => $referencia->{$field})->filter())

                            @forelse($imagenes as $imagen)
                                <img src="{{ asset('storage/' . $imagen) }}" alt="" width="56" height="42" class="me-1 rounded" style="object-fit: cover;">
                            @empty
                                <span class="text-muted">Sin imagenes</span>
                            @endforelse
                        </td>
                        <td>{{ optional($referencia->created_at)->format('d/m/Y') ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.referencias.edit', $referencia) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.referencias.destroy', $referencia) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Eliminar referencia?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Sin referencias cargadas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
