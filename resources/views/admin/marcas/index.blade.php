@extends('layouts.admin')

@section('title', 'Marcas')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Marcas</h3>
        <small class="text-muted">Gestion de marcas</small>
    </div>

    <a href="{{ route('admin.marcas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nueva marca
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
                    <th class="text-end"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($marcas as $marca)
                <tr>
                    <td class="fw-bold">#{{ $marca->id }}</td>
                    <td>{{ $marca->nombre }}</td>
                    <td>
                        <span class="badge bg-light text-dark">
                            {{ $marca->slug }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.marcas.edit', $marca) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('admin.marcas.destroy', $marca) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Eliminar esta marca?')">
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
