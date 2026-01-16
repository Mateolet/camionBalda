@extends('layouts.admin')

@section('content')
<h3>Editar camión</h3>

<form method="POST" action="{{ route('admin.camiones.update', $camion) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.camiones.form')
</form>

@if($camion->imagenes->count())
    @foreach($camion->imagenes as $imagen)
        <form id="delete-image-{{ $imagen->id }}" method="POST" action="{{ route('admin.camiones.imagenes.destroy', [$camion, $imagen]) }}" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
@endif
@endsection
