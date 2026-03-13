@extends('layouts.admin')

@section('title', 'Nuevo modelo')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Nuevo modelo</h3>
    <small class="text-muted">Crea un nuevo modelo</small>
</div>

<form method="POST" action="{{ route('admin.modelos.store') }}">
    @include('admin.modelos.form')
</form>

@endsection
