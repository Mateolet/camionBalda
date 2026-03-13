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
    <div class="card-body border-bottom">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label mb-1">Marca</label>
                <select id="filtro-marca" class="form-select">
                    <option value="">Todas</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->nombre }}">
                            {{ $marca->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mb-1">Categoria</label>
                <select id="filtro-categoria" class="form-select">
                    <option value="">Todas</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->nombre }}">
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mb-1">Nombre</label>
                <input type="text" id="filtro-nombre" class="form-control" placeholder="Nombre del camion">
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Nombre</th>
                    <th>Modelo</th>
                    <th>Imagenes</th>
                    <th>Año</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th class="text-end"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($camiones as $camion)
                    <tr data-nombre="{{ $camion->nombre ?? '' }}"
                        data-marca="{{ $camion->marca->nombre ?? '' }}"
                        data-categoria="{{ $camion->categoria->nombre ?? '' }}">
                    <td class="fw-bold">#{{ $camion->id }}</td>
                    <td>{{ $camion->marca->nombre ?? '-' }}</td>
                    <td>{{ $camion->nombre ?? '-' }}</td>
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
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#camion-detalle-{{ $camion->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
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
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Sin resultados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @foreach($camiones as $camion)
        <div class="modal fade" id="camion-detalle-{{ $camion->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalles del camion #{{ $camion->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="small text-muted">Nombre</div>
                                <div class="fw-semibold">{{ $camion->nombre ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-muted">Categoria</div>
                                <div class="fw-semibold">{{ $camion->categoria->nombre ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-muted">Marca</div>
                                <div class="fw-semibold">{{ $camion->marca->nombre ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-muted">Modelo</div>
                                <div class="fw-semibold">{{ $camion->modelo->nombre ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Medida</div>
                                <div class="fw-semibold">{{ $camion->medida ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Anio</div>
                                <div class="fw-semibold">{{ $camion->anio ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Precio</div>
                                <div class="fw-semibold">
                                    @if(!is_null($camion->precio))
                                        ${{ number_format($camion->precio, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Kilometros</div>
                                <div class="fw-semibold">{{ $camion->kilometros ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Ubicacion</div>
                                <div class="fw-semibold">{{ $camion->ubicacion ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Condicion</div>
                                <div class="fw-semibold">{{ $camion->condicion ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Combustible</div>
                                <div class="fw-semibold">{{ $camion->combustible ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Transmision</div>
                                <div class="fw-semibold">{{ $camion->transmision ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Motor</div>
                                <div class="fw-semibold">{{ $camion->motor ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Transmision detalle</div>
                                <div class="fw-semibold">{{ $camion->transmision_detalle ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Ejes</div>
                                <div class="fw-semibold">{{ $camion->ejes ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Suspension</div>
                                <div class="fw-semibold">{{ $camion->suspension ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Cabina</div>
                                <div class="fw-semibold">{{ $camion->cabina ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Peso bruto</div>
                                <div class="fw-semibold">{{ $camion->peso_bruto ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Distancia ejes</div>
                                <div class="fw-semibold">{{ $camion->distancia_ejes ?? '-' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Capacidad tanque</div>
                                <div class="fw-semibold">{{ $camion->capacidad_tanque ?? '-' }}</div>
                            </div>
                            <div class="col-12">
                                <div class="small text-muted">Descripcion corta</div>
                                <div class="fw-semibold">{{ $camion->descripcion_corta ?? '-' }}</div>
                            </div>
                            <div class="col-12">
                                <div class="small text-muted">Descripcion</div>
                                <div class="fw-semibold">{{ $camion->descripcion ?? '-' }}</div>
                            </div>
                            <div class="col-12">
                                <div class="small text-muted">Equipamiento</div>
                                <div class="fw-semibold">{{ $camion->equipamiento ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    (function () {
        const filtroNombre = document.getElementById('filtro-nombre');
        const filtroMarca = document.getElementById('filtro-marca');
        const filtroCategoria = document.getElementById('filtro-categoria');
        const filas = Array.from(document.querySelectorAll('tbody tr'));

        function normalize(value) {
            return (value || '').toString().toLowerCase().trim();
        }

        function aplicarFiltros() {
            const nombre = normalize(filtroNombre.value);
            const marca = normalize(filtroMarca.value);
            const categoria = normalize(filtroCategoria.value);

            filas.forEach((fila) => {
                if (!fila.dataset.nombre && !fila.dataset.marca && !fila.dataset.categoria) {
                    return;
                }

                const rowNombre = normalize(fila.dataset.nombre);
                const rowMarca = normalize(fila.dataset.marca);
                const rowCategoria = normalize(fila.dataset.categoria);

                const matchNombre = !nombre || rowNombre.includes(nombre);
                const matchMarca = !marca || rowMarca === marca;
                const matchCategoria = !categoria || rowCategoria === categoria;

                fila.style.display = matchNombre && matchMarca && matchCategoria ? '' : 'none';
            });
        }

        filtroNombre.addEventListener('input', aplicarFiltros);
        filtroMarca.addEventListener('change', aplicarFiltros);
        filtroCategoria.addEventListener('change', aplicarFiltros);
    })();
</script>

@endsection
