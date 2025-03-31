@extends('layouts.app') <!-- Extiende el layout principal -->

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Asistencias de Empleados</h1>

    <!-- Botón de navegación -->
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('admin.index') }}" class="btn btn-primary">
            ← Regresar al Dashboard
        </a>
    </div>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Tabla de asistencias -->
    @if($asistencias->isEmpty())
        <div class="alert alert-warning text-center">
            No hay asistencias registradas.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Empleado</th>
                        <th>Fecha</th>
                        <th>Hora de Entrada</th>
                        <th>Hora de Salida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asistencias as $asistencia)
                        <tr>
                            <td>{{ $asistencia->empleado->nombre }} {{ $asistencia->empleado->apellido_paterno }}</td>
                            <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($asistencia->hora_inicio)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($asistencia->hora_fin)->format('h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
