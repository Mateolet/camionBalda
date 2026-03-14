@csrf

<div class="card mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Datos del modelo</h5>

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="marca_id" class="form-select">
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}"
                        @selected(old('marca_id', $modelo->marca_id ?? '') == $marca->id)>
                        {{ $marca->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input name="nombre" class="form-control"
                   value="{{ old('nombre', $modelo->nombre ?? '') }}">
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.modelos.index') }}" class="btn btn-light">Cancelar</a>
    <button class="btn btn-primary">Guardar</button>
</div>
