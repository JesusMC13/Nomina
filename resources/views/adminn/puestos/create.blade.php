@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Agregar Nuevo Puesto</h2>

    <form action="{{ route('adminn.puestos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_puesto">Nombre del Puesto</label>
            <input type="text" class="form-control" id="nombre_puesto" name="nombre_puesto" required>
        </div>
        <div class="form-group">
            <label for="salario_base">Salario Base</label>
            <input type="number" class="form-control" id="salario_base" name="salario_base" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Puesto</button>
    </form>
</div>
@endsection
