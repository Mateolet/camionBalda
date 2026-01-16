@extends('layouts.admin')

@section('content')
<h3>Nuevo camión</h3>

<form method="POST" action="{{ route('admin.camiones.store') }}" enctype="multipart/form-data">
    @include('admin.camiones.form')
</form>
@endsection
