@extends('layouts.admin')

@section('title', 'Camiones')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Camiones</h3>
        <small class="text-muted">Gestión de unidades</small>
    </div>

    <a href="{{ route('admin.camiones.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo camión
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Imagenes</th>
                    <th>Año</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th class="text-end"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($camiones as $camion)
                <tr>
                    <td class="fw-bold">#{{ $camion->id }}</td>
                    <td>{{ $camion->marca->nombre ?? '-' }}</td>
                    <td>{{ $camion->modelo->nombre ?? '-' }}</td>
                    <td>
                        @forelse($camion->imagenes->take(3) as $imagen)
                            <img src="{{ asset('storage/' . $imagen->url) }}" alt="" width="48" height="36" class="me-1 rounded" style="object-fit: cover;">
                        @empty
                            <span class="text-muted">Sin imagenes</span>
                        @endforelse
                    </td>
                    <td>{{ $camion->anio }}</td>
                    <td>${{ number_format($camion->precio, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $camion->estado === 'publicado' ? 'success' : 'secondary' }}">
                            {{ ucfirst($camion->estado) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.camiones.edit', $camion) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('admin.camiones.destroy', $camion) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('¿Eliminar camión?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
