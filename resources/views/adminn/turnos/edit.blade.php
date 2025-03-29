@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Editar Turno</h1>

        <form action="{{ route('adminn.turnos.update', $turno->ID_turno) }}" method="POST">
            @csrf
            @method('PUT') <!-- Add this line to specify the PUT method -->

            <!-- Campos del formulario -->
            <div class="form-group">
                <label for="nombre_turno">Nombre del Turno</label>
                <input type="text" name="nombre_turno" value="{{ old('nombre_turno', $turno->nombre_turno) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hora_entrada">Hora de Entrada</label>
                <input type="time" name="hora_entrada" value="{{ old('hora_entrada', $turno->hora_entrada) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hora_salida">Hora de Salida</label>
                <input type="time" name="hora_salida" value="{{ old('hora_salida', $turno->hora_salida) }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Turno</button>
        </form>
    </div>
@endsection
