@extends('layouts.admin')

@section('title', 'Editar modelo')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Editar modelo</h3>
    <small class="text-muted">Actualiza los datos del modelo</small>
</div>

<form method="POST" action="{{ route('admin.modelos.update', $modelo) }}">
    @csrf
    @method('PUT')
    @include('admin.modelos.form')
</form>

@endsection
