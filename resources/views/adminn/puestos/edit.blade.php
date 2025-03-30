@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Editar Puesto</h2>

    <form action="{{ route('adminn.puestos.update', $puesto->id_puesto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_puesto">Nombre del Puesto</label>
            <input type="text" class="form-control" id="nombre_puesto" name="nombre_puesto" value="{{ $puesto->nombre_puesto }}" required>
        </div>
        <div class="form-group">
            <label for="salario_base">Salario Base</label>
            <input type="number" class="form-control" id="salario_base" name="salario_base" value="{{ $puesto->salario_base }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Puesto</button>
    </form>
</div>
@endsection
