@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-sm btn-light mr-2">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h5 class="mb-0 d-inline-block">
                                <i class="fas fa-calendar-alt mr-2"></i>Mi Horario
                            </h5>
                        </div>
                        @if($empleado->turno)
                            <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#helpModal">
                                <i class="fas fa-question-circle"></i>
                            </a>
                        @endif
                    </div>

                    <div class="card-body">
                        <!-- Botón de regreso alternativo (para móviles) -->
                        <div class="d-block d-md-none mb-3">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-arrow-left mr-2"></i>Regresar al Dashboard
                            </a>
                        </div>
                <div class="card-body">
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

                    <!-- Detalles del Horario -->
                    <div class="p-3 border rounded bg-light">
                        <h6 class="font-weight-bold text-primary mb-3">
                            <i class="fas fa-clock mr-2"></i>Detalles del Horario
                        </h6>

                        @if($empleado->turno)
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Turno:</div>
                            <div class="col-sm-8">
                                <span class="badge badge-primary">{{ $empleado->turno->nombre_turno }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Horario:</div>
                            <div class="col-sm-8">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="fas fa-sign-in-alt text-success mr-2"></i>
                                    <span>Entrada: {{ $empleado->hora_entrada ? date('h:i A', strtotime($empleado->hora_entrada)) : date('h:i A', strtotime($empleado->turno->hora_entrada)) }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-sign-out-alt text-danger mr-2"></i>
                                    <span>Salida: {{ date('h:i A', strtotime($empleado->turno->hora_salida)) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 font-weight-bold">Tolerancia:</div>
                            <div class="col-sm-8">{{ $empleado->turno->tolerancia_minutos }} minutos</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 font-weight-bold">Días laborales:</div>
                            <div class="col-sm-8">{{ $empleado->turno->dias_laborales }}</div>
                        </div>
                        @else
                        <div class="alert alert-warning mb-0">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            No tienes un turno asignado actualmente.
                        </div>
                        @endif
                    </div>

                    <!-- Historial de cambios (opcional) -->
                    @if($empleado->turno)
                    <div class="mt-4">
                        <a href="{{ route('empleado.horarios.create') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit mr-1"></i>Solicitar cambio de horario
                        </a>
                    </div>
                    @endif
                </div>

                <div class="card-footer text-muted small">
                    <i class="fas fa-info-circle mr-1"></i>
                    Última actualización: {{ $empleado->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Ayuda -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-question-circle mr-2"></i>Ayuda sobre horarios
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Esta sección muestra tu horario laboral asignado:</p>
                <ul>
                    <li><strong>Turno:</strong> Nombre de tu turno asignado</li>
                    <li><strong>Horario:</strong> Hora de entrada y salida establecida</li>
                    <li><strong>Tolerancia:</strong> Minutos de gracia para el registro de asistencia</li>
                    <li><strong>Días laborales:</strong> Días que debes presentarte a trabajar</li>
                </ul>
                <p class="mb-0">Para solicitar cambios, utiliza el botón "Solicitar cambio de horario".</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
    .fa-sign-in-alt, .fa-sign-out-alt {
        width: 1.25em;
        text-align: center;
    }
</style>
@endsection
