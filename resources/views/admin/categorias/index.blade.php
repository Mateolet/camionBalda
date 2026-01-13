@extends('layouts.admin')

@section('title', 'Categorías')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Categorías</h3>
        <small class="text-muted">Organización de camiones</small>
    </div>

    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nueva categoría
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Visible</th>
                    <th>Orden</th>
                    <th class="text-end"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td class="fw-bold">#{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        <span class="badge bg-light text-dark">
                            {{ $categoria->slug }}
                        </span>
                    </td>
                    <td>
                        @if($categoria->visible)
                            <span class="badge bg-success">Visible</span>
                        @else
                            <span class="badge bg-secondary">Oculta</span>
                        @endif
                    </td>
                    <td>{{ $categoria->orden ?? '-' }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.categorias.edit', $categoria) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('admin.categorias.destroy', $categoria) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('¿Eliminar esta categoría?')">
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
