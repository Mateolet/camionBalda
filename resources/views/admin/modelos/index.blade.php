@extends('layouts.admin')

@section('title', 'Modelos')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Modelos</h3>
        <small class="text-muted">Gestion de modelos</small>
    </div>

    <a href="{{ route('admin.modelos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo modelo
    </a>
</div>

<div class="card">
    <div class="card-body border-bottom">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-6">
                <label class="form-label mb-1">Buscar</label>
                <input type="text" id="filtro-modelos" class="form-control" placeholder="Nombre o slug">
            </div>
        </div>
    </div>
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
                @forelse($modelos as $modelo)
                    <tr data-nombre="{{ $modelo->nombre ?? '' }}" data-slug="{{ $modelo->slug ?? '' }}">
                        <td class="fw-bold">#{{ $modelo->id }}</td>
                        <td>{{ $modelo->nombre }}</td>
                        <td>
                            <span class="badge bg-light text-dark">
                                {{ $modelo->slug }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.modelos.edit', $modelo) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.modelos.destroy', $modelo) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Eliminar este modelo?')">
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
                        <td colspan="4" class="text-center text-muted py-4">
                            Sin resultados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    (function () {
        const filtro = document.getElementById('filtro-modelos');
        const filas = Array.from(document.querySelectorAll('tbody tr'));

        function normalize(value) {
            return (value || '').toString().toLowerCase().trim();
        }

        function aplicarFiltro() {
            const q = normalize(filtro.value);

            filas.forEach((fila) => {
                if (!fila.dataset.nombre && !fila.dataset.slug) {
                    return;
                }

                const nombre = normalize(fila.dataset.nombre);
                const slug = normalize(fila.dataset.slug);
                const match = !q || nombre.includes(q) || slug.includes(q);

                fila.style.display = match ? '' : 'none';
            });
        }

        filtro.addEventListener('input', aplicarFiltro);
    })();
</script>

@endsection
