@extends('layouts.admin')

@section('title', 'Editar categoría')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Editar categoría</h3>
    <small class="text-muted">Modificá la información</small>
</div>

<form method="POST" action="{{ route('admin.categorias.update', $categoria) }}">
    @method('PUT')
    @include('admin.categorias.form')
</form>

@endsection
