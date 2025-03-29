<!-- resources/views/adminn/turnos/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Crear Turno</h1>

    <form action="{{ route('adminn.turnos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_turno">Nombre del Turno</label>
            <input type="text" class="form-control" id="nombre_turno" name="nombre_turno" required>
        </div>
        <div class="form-group">
            <label for="hora_entrada">Hora de Entrada</label>
            <input type="time" class="form-control" id="hora_entrada" name="hora_entrada" required>
        </div>
        <div class="form-group">
            <label for="hora_salida">Hora de Salida</label>
            <input type="time" class="form-control" id="hora_salida" name="hora_salida" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Turno</button>
    </form>
</div>
@endsection
