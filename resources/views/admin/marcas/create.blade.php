@extends('layouts.admin')

@section('title', 'Nueva marca')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Nueva marca</h3>
    <small class="text-muted">Crea una nueva marca</small>
</div>

<form method="POST" action="{{ route('admin.marcas.store') }}">
    @include('admin.marcas.form')
</form>

@endsection
