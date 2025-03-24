@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="h3 mb-4 text-gray-800 text-center">Modificar Turno Semanal</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h6 class="m-0 font-weight-bold">Empleado: {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('adminn.modificar.turno', $empleado->ID_empleado) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="turno">Nuevo Turno:</label>
                    <input type="text" id="turno" name="turno" class="form-control" value="{{ $empleado->turno ?? '' }}" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar Turno</button>
                <a href="{{ route('adminn.modificar.turnos') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection
