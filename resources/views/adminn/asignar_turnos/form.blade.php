// resources/views/adminn/asignar_turnos/form.blade.php

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Asignar Turno a: {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('adminn.asignar.turnos') }}" class="btn btn-secondary">Regresar a la lista de empleados</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Asignación de Turno</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('adminn.asignar.turno', $empleado->ID_empleado) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="turno_id">Nuevo Turno:</label>
                    <select name="turno_id" id="turno_id" class="form-control" required>
                        <option value="">Seleccione un turno</option>
                        @foreach($turnos as $turno)
                            <option value="{{ $turno->ID_turno }}" {{ $empleado->turno_id == $turno->ID_turno ? 'selected' : '' }}>
                                {{ $turno->nombre_turno }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Asignar Turno</button>
            </form>
        </div>
    </div>
</div>
@endsection
