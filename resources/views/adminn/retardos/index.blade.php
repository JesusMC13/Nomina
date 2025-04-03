@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Retardos Registrados</h1>
            <div>
                <form action="{{ route('adminn.retardos.actualizar') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-warning mr-2">
                        <i class="fas fa-sync-alt mr-2"></i> Actualizar Retardos
                    </button>
                </form>
                <a href="{{ route('admin.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i> Regresar
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th>Empleado</th>
                            <th>Puesto</th>
                            <th>Fecha</th>
                            <th>Hora Esperada</th>
                            <th>Hora Real</th>
                            <th class="text-center">Retraso</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($asistencias as $asistencia)
                            <tr>
                                <td>{{ $asistencia->empleado->nombre_completo }}</td>
                                <td>{{ $asistencia->empleado->puesto->nombre_puesto ?? 'N/A' }}</td>
                                <td>{{ $asistencia->fecha->format('d/m/Y') }}</td>
                                <td>{{ $asistencia->empleado->turno->hora_entrada ?? 'N/A' }}</td>
                                <td>{{ $asistencia->hora_entrada_formateada }}</td>
                                <td class="text-center">
                    <span class="badge badge-danger">
                        {{ floor($asistencia->minutos_retraso / 60) }}h {{ $asistencia->minutos_retraso % 60 }}m
                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron registros de retardos</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $asistencias->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
