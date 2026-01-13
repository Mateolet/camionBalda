@csrf

<div class="card mb-4">
<div class="card-body">
<h5 class="fw-bold mb-3">Datos del camión</h5>

<div class="row g-3">

{{-- CATEGORIA / MARCA / MODELO --}}
<div class="col-md-4">
    <label class="form-label">Categoría</label>
    <select name="categoria_id" class="form-select">
        @foreach($categorias as $c)
            <option value="{{ $c->id }}"
                @selected(old('categoria_id', $camion->categoria_id ?? '') == $c->id)>
                {{ $c->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-4">
    <label class="form-label">Marca</label>
    <select name="marca_id" class="form-select">
        @foreach($marcas as $m)
            <option value="{{ $m->id }}"
                @selected(old('marca_id', $camion->marca_id ?? '') == $m->id)>
                {{ $m->nombre }}
            </option>
        @endforeach
    </select>
</div>


{{-- MEDIDA / AÑO / PRECIO --}}
<div class="col-md-3">
    <label class="form-label">Medida</label>
    <input name="medida" class="form-control"
           value="{{ old('medida', $camion->medida ?? '') }}">
</div>

<div class="col-md-3">
    <label class="form-label">Año</label>
    <input type="number" name="anio" class="form-control"
           value="{{ old('anio', $camion->anio ?? '') }}">
</div>

<div class="col-md-3">
    <label class="form-label">Precio</label>
    <input type="number" name="precio" class="form-control"
           value="{{ old('precio', $camion->precio ?? '') }}">
</div>

<div class="col-md-3">
    <label class="form-label">Kilómetros</label>
    <input type="number" name="kilometros" class="form-control"
           value="{{ old('kilometros', $camion->kilometros ?? '') }}">
</div>

{{-- TECNICOS --}}
<div class="col-md-4">
    <label class="form-label">Combustible</label>
    <input name="combustible" class="form-control"
           value="{{ old('combustible', $camion->combustible ?? '') }}">
</div>

<div class="col-md-4">
    <label class="form-label">Transmisión</label>
    <input name="transmision" class="form-control"
           value="{{ old('transmision', $camion->transmision ?? '') }}">
</div>

<div class="col-md-4">
    <label class="form-label">Motor</label>
    <input name="motor" class="form-control"
           value="{{ old('motor', $camion->motor ?? '') }}">
</div>

{{-- DESCRIPCION --}}
<div class="col-md-12">
    <label class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control" rows="3">
{{ old('descripcion', $camion->descripcion ?? '') }}
</textarea>
</div>

{{-- ESTADO --}}
<div class="col-md-3">
    <label class="form-label">Estado</label>
    <select name="estado" class="form-select">
        <option value="publicado" @selected(old('estado', $camion->estado ?? '') == 'publicado')>Publicado</option>
        <option value="borrador" @selected(old('estado', $camion->estado ?? '') == 'borrador')>Borrador</option>
    </select>
</div>

</div>
</div>
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.camiones.index') }}" class="btn btn-light">Cancelar</a>
    <button class="btn btn-primary">Guardar</button>
</div>
