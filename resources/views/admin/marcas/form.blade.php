@csrf

<div class="card mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Datos de la marca</h5>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text"
                       name="nombre"
                       class="form-control"
                       placeholder="Ej: Volvo"
                       value="{{ old('nombre', $marca->nombre ?? '') }}"
                       required>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.marcas.index') }}" class="btn btn-light">
        Cancelar
    </a>
    <button class="btn btn-primary">
        <i class="bi bi-save"></i> Guardar
    </button>
</div>
