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
    <div class="card-body border-bottom">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <label class="form-label mb-1">Buscar</label>
                <input type="text" id="filtro-categorias-texto" class="form-control" placeholder="Nombre o slug">
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mb-1">Visible</label>
                <select id="filtro-categorias-visible" class="form-select">
                    <option value="">Todas</option>
                    <option value="1">Visible</option>
                    <option value="0">Oculta</option>
                </select>
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
                    <th>Visible</th>
                    <th>Orden</th>
                    <th class="text-end"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categorias as $categoria)
                <tr data-nombre="{{ $categoria->nombre ?? '' }}" data-slug="{{ $categoria->slug ?? '' }}" data-visible="{{ $categoria->visible ? '1' : '0' }}">
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
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
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
        const filtroTexto = document.getElementById('filtro-categorias-texto');
        const filtroVisible = document.getElementById('filtro-categorias-visible');
        const filas = Array.from(document.querySelectorAll('tbody tr'));

        function normalize(value) {
            return (value || '').toString().toLowerCase().trim();
        }

        function aplicarFiltro() {
            const q = normalize(filtroTexto.value);
            const visible = normalize(filtroVisible.value);

            filas.forEach((fila) => {
                if (!fila.dataset.nombre && !fila.dataset.slug && !fila.dataset.visible) {
                    return;
                }

                const nombre = normalize(fila.dataset.nombre);
                const slug = normalize(fila.dataset.slug);
                const rowVisible = normalize(fila.dataset.visible);

                const matchTexto = !q || nombre.includes(q) || slug.includes(q);
                const matchVisible = !visible || rowVisible === visible;

                fila.style.display = matchTexto && matchVisible ? '' : 'none';
            });
        }

        filtroTexto.addEventListener('input', aplicarFiltro);
        filtroVisible.addEventListener('change', aplicarFiltro);
    })();
</script>

@endsection
