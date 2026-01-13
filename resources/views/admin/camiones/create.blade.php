@extends('layouts.admin')

@section('content')
<h3>Nuevo camión</h3>

<form method="POST" action="{{ route('admin.camiones.store') }}">
    @include('admin.camiones.form')
</form>
@endsection
