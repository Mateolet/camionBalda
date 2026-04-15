@extends('layouts.admin')

@section('title', 'Nueva referencia')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Nueva referencia</h3>
    <small class="text-muted">Carga una publicacion con hasta 5 imagenes</small>
</div>

<form method="POST" action="{{ route('admin.referencias.store') }}" enctype="multipart/form-data">
    @include('admin.referencias.form')
</form>

@endsection
