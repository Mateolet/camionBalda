@extends('layouts.admin')

@section('title', 'Nueva categoría')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Nueva categoría</h3>
    <small class="text-muted">Creá una nueva categoría</small>
</div>

<form method="POST" action="{{ route('admin.categorias.store') }}">
    @include('admin.categorias.form')
</form>

@endsection
