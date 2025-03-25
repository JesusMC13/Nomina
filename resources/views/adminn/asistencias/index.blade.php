@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Consultar Asistencias de Empleados</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Asistencias</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="asistenciasTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Fecha</th>
                            <th>Hora de Entrada</th>
                            <th>Hora de Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($asistencias as $asistencia)
                        <tr>
                            <td>{{ $asistencia->empleado->nombre }} {{ $asistencia->empleado->apellido_paterno }}</td>
                            <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($asistencia->hora_inicio)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($asistencia->hora_fin)->format('h:i A') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
