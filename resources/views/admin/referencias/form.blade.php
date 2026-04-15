@csrf

<div class="card mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Datos de referencia</h5>

        @if($errors->any())
            <div class="alert alert-danger">
                Revisar los campos marcados.
            </div>
        @endif

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Publicacion</label>
                <input type="text"
                       name="publicacion"
                       class="form-control @error('publicacion') is-invalid @enderror"
                       value="{{ old('publicacion', $referencia->publicacion ?? '') }}"
                       maxlength="255"
                       required>
                @error('publicacion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Descripcion</label>
                <textarea name="descripcion"
                          class="form-control @error('descripcion') is-invalid @enderror"
                          rows="3">{{ old('descripcion', $referencia->descripcion ?? '') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @foreach(['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5'] as $field)
                @php($actual = $referencia->{$field} ?? null)
                <div class="col-md-6">
                    <label class="form-label">{{ ucfirst($field) }}</label>

                    @if(!empty($actual))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $actual) }}" alt="" width="140" height="100" class="rounded border" style="object-fit: cover;">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="eliminar_{{ $field }}" value="1" id="eliminar-{{ $field }}">
                                <label class="form-check-label" for="eliminar-{{ $field }}">
                                    Eliminar imagen actual
                                </label>
                            </div>
                        </div>
                    @endif

                    <input type="file"
                           name="{{ $field }}"
                           class="form-control @error($field) is-invalid @enderror"
                           accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                    @error($field)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.referencias.index') }}" class="btn btn-light">
        Cancelar
    </a>
    <button class="btn btn-primary">
        <i class="bi bi-save"></i> Guardar
    </button>
</div>
