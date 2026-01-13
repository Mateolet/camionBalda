@csrf

<div class="card mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Información de la categoría</h5>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text"
                       name="nombre"
                       class="form-control"
                       placeholder="Ej: Tractores"
                       value="{{ old('nombre', $categoria->nombre ?? '') }}"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Orden</label>
                <input type="number"
                       name="orden"
                       class="form-control"
                       placeholder="Ej: 1"
                       value="{{ old('orden', $categoria->orden ?? '') }}">
            </div>

            <div class="col-md-12">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion"
                          class="form-control"
                          rows="3"
                          placeholder="Descripción breve">{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
            </div>

            <div class="col-md-4">
                <label class="form-label">Visible</label>
                <select name="visible" class="form-select">
                    <option value="1" @selected(old('visible', $categoria->visible ?? 1) == 1)>
                        Sí
                    </option>
                    <option value="0" @selected(old('visible', $categoria->visible ?? 1) == 0)>
                        No
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.categorias.index') }}" class="btn btn-light">
        Cancelar
    </a>
    <button class="btn btn-primary">
        <i class="bi bi-save"></i> Guardar
    </button>
</div>
