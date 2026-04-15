@extends('layouts.admin')

@section('title', 'Editar referencia')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Editar referencia</h3>
    <small class="text-muted">Actualiza la publicacion o sus imagenes</small>
</div>

<form method="POST" action="{{ route('admin.referencias.update', $referencia) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.referencias.form')
</form>

@endsection
