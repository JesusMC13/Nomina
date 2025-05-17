@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <!-- Encabezado mejorado -->
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('empleado.dashboard') }}" class="btn btn-sm btn-light me-2">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <span class="h5 mb-0 align-middle">
                                <i class="fas fa-calendar-alt me-2"></i>Mis Días de Descanso
                            </span>
                            </div>
                            <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#helpModal">
                                <i class="fas fa-question-circle"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Información del empleado -->
                        <div class="info-box bg-blue-10 p-3 rounded mb-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-blue-20 text-primary me-3">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Empleado</small>
                                            <strong>{{ $empleado->nombre_completo }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-blue-20 text-primary me-3">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Puesto</small>
                                            <strong>{{ $empleado->puesto->nombre_puesto ?? 'No asignado' }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Panel principal -->
                        <div class="main-panel p-4 border rounded">
                            <h5 class="section-title text-primary mb-4">
                                <i class="fas fa-calendar-day me-2"></i>Días Asignados
                            </h5>

                            @if($empleado->diasDescanso && $empleado->diasDescanso->count() > 0)
                                <!-- Días de descanso -->
                                <div class="days-container mb-4">
                                    @foreach($empleado->diasDescanso as $dia)
                                        <div class="day-item bg-blue-10 text-primary rounded-pill">
                                            <i class="fas fa-check-circle me-2"></i>{{ $dia->nombre_dia }}
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Próximo descanso -->
                                @php
                                    $proximoDescanso = $empleado->calcularProximoDescanso();
                                @endphp

                                <div class="next-rest bg-blue-10 p-3 rounded">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-primary text-white me-3">
                                            <i class="fas fa-calendar-star"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Próximo Descanso</h6>
                                            @if(isset($proximoDescanso['fecha']))
                                                <p class="mb-0">
                                                    <span class="fw-bold">{{ $proximoDescanso['dia'] }}</span>
                                                    <small class="text-muted ms-2">({{ $proximoDescanso['fecha']->format('d/m/Y') }})</small>
                                                </p>
                                            @else
                                                <p class="mb-0 text-muted">No disponible</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Sin días asignados</h6>
                                        <p class="mb-0">No tienes días de descanso configurados</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Nota informativa -->
                        <div class="info-note bg-blue-10 p-3 rounded mt-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-primary me-3"></i>
                                <p class="mb-0 small">Los días de descanso son asignados por el departamento de RRHH según tu turno laboral.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-sync-alt me-1"></i>
                                Actualizado: {{ $empleado->updated_at->format('d/m/Y H:i') }}
                            </small>
                            <small>
                                <i class="fas fa-calendar me-1"></i>
                                {{ now()->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de ayuda -->
    <div class="modal fade" id="helpModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle me-2"></i>Ayuda
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="help-item mb-3">
                        <div class="d-flex align-items-start">
                            <div class="icon-circle bg-blue-20 text-primary me-3">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div>
                                <h6>Días de Descanso</h6>
                                <p class="small text-muted mb-0">Son los días fijos asignados para tu descanso semanal.</p>
                            </div>
                        </div>
                    </div>
                    <div class="help-item mb-3">
                        <div class="d-flex align-items-start">
                            <div class="icon-circle bg-blue-20 text-primary me-3">
                                <i class="fas fa-star"></i>
                            </div>
                            <div>
                                <h6>Próximo Descanso</h6>
                                <p class="small text-muted mb-0">Muestra la fecha de tu próximo día libre.</p>
                            </div>
                        </div>
                    </div>
                    <div class="help-item">
                        <div class="d-flex align-items-start">
                            <div class="icon-circle bg-blue-20 text-primary me-3">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <div>
                                <h6>Cambios</h6>
                                <p class="small text-muted mb-0">Para modificar tus días, contacta a RRHH.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-check me-1"></i>Entendido
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Colores personalizados */
        .bg-primary {
            background-color: #2c6ecb !important;
        }
        .bg-blue-10 {
            background-color: rgba(44, 110, 203, 0.1);
        }
        .bg-blue-20 {
            background-color: rgba(44, 110, 203, 0.2);
        }
        .text-primary {
            color: #2c6ecb !important;
        }

        /* Componentes */
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .card-header {
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-panel {
            border: 1px solid rgba(44, 110, 203, 0.2);
        }
        .section-title {
            font-weight: 600;
            border-bottom: 2px solid rgba(44, 110, 203, 0.3);
            padding-bottom: 8px;
        }
        .days-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .day-item {
            padding: 8px 16px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        .next-rest {
            border-left: 3px solid #2c6ecb;
        }
        .info-note {
            border-left: 3px solid #2c6ecb;
        }

        /* Efectos */
        .btn-light {
            background-color: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.2);
        }
        .btn-light:hover {
            background-color: rgba(255,255,255,0.25);
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
