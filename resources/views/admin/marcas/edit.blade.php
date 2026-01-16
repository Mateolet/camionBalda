@extends('layouts.admin')

@section('title', 'Editar marca')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Editar marca</h3>
    <small class="text-muted">Modifica la informacion</small>
</div>

<form method="POST" action="{{ route('admin.marcas.update', $marca) }}">
    @method('PUT')
    @include('admin.marcas.form')
</form>

@endsection
