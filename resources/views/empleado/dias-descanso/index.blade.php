@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-sm btn-light mr-2">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h5 class="mb-0 d-inline-block">
                                <i class="fas fa-bed mr-2"></i>Mis Días de Descanso
                            </h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Botón de regreso alternativo (para móviles) -->
                        <div class="d-block d-md-none mb-3">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-arrow-left mr-2"></i>Regresar al Dashboard
                            </a>
                        </div>

                        <!-- Información Básica -->
                        <div class="mb-4 p-3 border rounded">
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Empleado:</div>
                                <div class="col-sm-8">{{ $empleado->nombre_completo }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Puesto:</div>
                                <div class="col-sm-8">{{ $empleado->puesto->nombre_puesto ?? 'No asignado' }}</div>
                            </div>
                        </div>

                        <!-- Días de Descanso -->
                        <div class="p-3 border rounded bg-light">
                            <h6 class="font-weight-bold text-info mb-3">
                                <i class="fas fa-calendar-day mr-2"></i>Días de Descanso Asignados
                            </h6>

                            @if($empleado->diasDescanso && $empleado->diasDescanso->count() > 0)
                                <div class="row mb-2">
                                    <div class="col-sm-4 font-weight-bold">Días:</div>
                                    <div class="col-sm-8">
                                        @foreach($empleado->diasDescanso as $dia)
                                            <span class="badge badge-info mr-2 mb-2">{{ $dia->nombre_dia }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 font-weight-bold">Próximo descanso:</div>
                                    <div class="col-sm-8">
                                        @php
                                            $proximoDescanso = $empleado->calcularProximoDescanso(); // Asumiendo que existe este método en el modelo
                                        @endphp
                                        <span class="font-weight-bold">{{ $proximoDescanso['dia'] ?? 'No disponible' }}</span>
                                        @if(isset($proximoDescanso['fecha']))
                                            ({{ $proximoDescanso['fecha']->format('d/m/Y') }})
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mb-0">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    No tienes días de descanso asignados actualmente.
                                </div>
                            @endif
                        </div>

                        <!-- Mensaje informativo -->
                        <div class="alert alert-info mt-4 mb-0">
                            <i class="fas fa-info-circle mr-2"></i>
                            Tus días de descanso son asignados por el administrador.
                            Para cualquier cambio, contacta con el departamento de RRHH.
                        </div>
                    </div>

                    <div class="card-footer text-muted small">
                        <i class="fas fa-info-circle mr-1"></i>
                        Última actualización: {{ $empleado->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 0.5rem;
        }
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
        .badge {
            font-size: 0.9em;
            padding: 0.35em 0.65em;
        }
    </style>
@endsection
