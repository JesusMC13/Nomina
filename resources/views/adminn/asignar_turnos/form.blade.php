@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Asignar Turno a Empleado</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <!-- Botón para Regresar al Dashboard -->
        <a href="{{ route('adminn.asignar.turnos') }}" class="btn btn-secondary">Regresar a la lista de empleados</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Asignar Turno a: {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('adminn.asignar.turno', ['ID_empleado' => $empleado->ID_empleado]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="turno">Turno:</label>
                    <input type="text" id="turno" name="turno" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Asignar Turno</button>
            </form>
        </div>
    </div>
</div>
@endsection
