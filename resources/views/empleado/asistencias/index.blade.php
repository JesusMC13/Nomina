@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Asistencias</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('empleado.dashboard') }}" class="btn btn-secondary">← Regresar al Dashboard</a>
        <a href="{{ route('empleado.asistencias.create') }}" class="btn btn-primary">Registrar Asistencia</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora de Entrada</th>
                <th>Hora de Salida</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora_inicio }}</td>
                    <td>{{ $asistencia->hora_fin }}</td>
                    <td>
                        <form action="{{ route('empleado.asistencias.destroy', $asistencia->ID_asistencia) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
