@extends('layouts.admin')

@section('content')
<h3>Editar camión</h3>

<form method="POST" action="{{ route('admin.camiones.update', $camion) }}">
    @method('PUT')
    @include('admin.camiones.form')
</form>
@endsection
