@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-lg">
                    <!-- Encabezado mejorado -->
                    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-sm btn-light mr-3 shadow-sm">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt mr-2"></i>Mi Horario Laboral
                            </h5>
                        </div>
                        @isset($empleado->turno)
                            <div>
                                <button class="btn btn-sm btn-light shadow-sm" data-toggle="modal" data-target="#helpModal"
                                        title="Ayuda sobre horarios">
                                    <i class="fas fa-question-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-success shadow-sm ml-2" id="printSchedule"
                                        title="Imprimir horario">
                                    <i class="fas fa-print"></i>
                                </button>
                            </div>
                        @endisset
                    </div>

                    <div class="card-body">
                        <!-- Botón de regreso para móviles -->
                        <div class="d-block d-md-none mb-4">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-outline-primary btn-block shadow-sm">
                                <i class="fas fa-arrow-left mr-2"></i>Volver al Dashboard
                            </a>
                        </div>

                        <!-- Tarjeta de información del empleado -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center mb-3 mb-md-0">
                                        <div class="avatar-lg mx-auto bg-primary-light rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user-tie fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <h5 class="text-primary mb-2">{{ $empleado->nombre_completo ?? 'Nombre no disponible' }}</h5>
                                        <div class="d-flex flex-wrap">
                                            <div class="mr-4 mb-2">
                                                <span class="text-muted small">Puesto:</span>
                                                <p class="mb-0 font-weight-bold">{{ $empleado->puesto->nombre_puesto ?? 'No asignado' }}</p>
                                            </div>
                                            <div class="mb-2">
                                                <span class="text-muted small">Departamento:</span>
                                                <p class="mb-0 font-weight-bold">{{ $empleado->departamento->nombre ?? 'No asignado' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta de horario con pestañas -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                                <ul class="nav nav-tabs card-header-tabs" id="scheduleTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="current-tab" data-toggle="tab" href="#current" role="tab">
                                            <i class="fas fa-calendar-day mr-1"></i> Horario Actual
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab">
                                            <i class="far fa-calendar-alt mr-1"></i> Calendario
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="scheduleTabsContent">
                                    <!-- Pestaña de horario actual -->
                                    <div class="tab-pane fade show active" id="current" role="tabpanel">
                                        @isset($empleado->turno)
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="schedule-card bg-primary-light rounded-lg p-4 h-100">
                                                        <h6 class="text-primary mb-3 d-flex align-items-center">
                                                            <i class="fas fa-info-circle mr-2"></i> Información del Turno
                                                        </h6>
                                                        <div class="schedule-detail mb-3">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="icon-circle bg-primary text-white mr-3">
                                                                    <i class="fas fa-tag"></i>
                                                                </div>
                                                                <div>
                                                                    <small class="text-muted">Nombre del Turno</small>
                                                                    <p class="mb-0 font-weight-bold">{{ $empleado->turno->nombre_turno }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="schedule-detail mb-3">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="icon-circle bg-primary text-white mr-3">
                                                                    <i class="fas fa-clock"></i>
                                                                </div>
                                                                <div>
                                                                    <small class="text-muted">Horario</small>
                                                                    <p class="mb-0">
                                                                        <span class="text-success">{{ $empleado->hora_entrada ? date('h:i A', strtotime($empleado->hora_entrada)) : date('h:i A', strtotime($empleado->turno->hora_entrada)) }}</span>
                                                                        <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                                                        <span class="text-danger">{{ date('h:i A', strtotime($empleado->turno->hora_salida)) }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="schedule-detail mb-3">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="icon-circle bg-primary text-white mr-3">
                                                                    <i class="fas fa-hourglass-half"></i>
                                                                </div>
                                                                <div>
                                                                    <small class="text-muted">Tolerancia</small>
                                                                    <p class="mb-0 font-weight-bold">{{ $empleado->turno->tolerancia_minutos }} minutos</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <div class="schedule-card bg-primary-light rounded-lg p-4 h-100">
                                                        <h6 class="text-primary mb-3 d-flex align-items-center">
                                                            <i class="fas fa-calendar-week mr-2"></i> Días Laborales
                                                        </h6>
                                                        <div class="working-days">
                                                            @php
                                                                $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                                                                $workingDays = isset($empleado->turno->dias_laborales) ? explode(',', $empleado->turno->dias_laborales) : [];
                                                            @endphp

                                                            @foreach($days as $day)
                                                                @if(in_array($day, $workingDays))
                                                                    <div class="day-item day-working mb-2">
                                                                        <i class="fas fa-check-circle text-success mr-2"></i>
                                                                        <span class="font-weight-bold">{{ $day }}</span>
                                                                    </div>
                                                                @else
                                                                    <div class="day-item day-off mb-2">
                                                                        <i class="fas fa-times-circle text-muted mr-2"></i>
                                                                        <span class="text-muted">{{ $day }}</span>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="alert alert-info mt-3 d-flex align-items-center">
                                                <i class="fas fa-info-circle fa-2x mr-3"></i>
                                                <div>
                                                    <h6 class="alert-heading">Recordatorio Importante</h6>
                                                    <p class="mb-0">Tu horario puede variar en días festivos o situaciones especiales. Consulta con tu supervisor cualquier cambio.</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning d-flex align-items-center">
                                                <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                                                <div>
                                                    <h6 class="alert-heading">Turno no asignado</h6>
                                                    <p class="mb-0">Actualmente no tienes un turno asignado. Por favor, contacta al departamento de Recursos Humanos.</p>
                                                </div>
                                            </div>
                                        @endisset
                                    </div>

                                    <!-- Pestaña de calendario -->
                                    <div class="tab-pane fade" id="calendar" role="tabpanel">
                                        <div id="scheduleCalendar" class="border rounded-lg"></div>
                                        <div class="mt-3">
                                            <div class="legend d-flex flex-wrap">
                                                <div class="mr-3 mb-2 d-flex align-items-center">
                                                    <span class="legend-color working-day mr-2"></span>
                                                    <small>Día laboral</small>
                                                </div>
                                                <div class="mr-3 mb-2 d-flex align-items-center">
                                                    <span class="legend-color day-off mr-2"></span>
                                                    <small>Día de descanso</small>
                                                </div>
                                                <div class="mr-3 mb-2 d-flex align-items-center">
                                                    <span class="legend-color holiday mr-2"></span>
                                                    <small>Día festivo</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección de acciones -->
                    </div>

                    <div class="card-footer bg-white border-top-0 text-muted small d-flex justify-content-between">
                        <div>
                            <i class="fas fa-info-circle mr-1"></i>
                            Última actualización: {{ $empleado->updated_at->format('d/m/Y H:i') ?? 'Fecha no disponible' }}
                        </div>
                        <div>
                            <i class="fas fa-sync-alt mr-1"></i>
                            <a href="#" class="text-muted" id="refreshSchedule">Actualizar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Ayuda -->
    <div class="modal fade" id="helpModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle mr-2"></i>Guía de Horarios
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary"><i class="fas fa-clock mr-2"></i>Horario Laboral</h6>
                            <p>Esta sección muestra tu horario asignado con los siguientes detalles:</p>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check-circle text-primary"></i></span><strong>Turno:</strong> Nombre del turno asignado</li>
                                <li><span class="fa-li"><i class="fas fa-check-circle text-primary"></i></span><strong>Horario:</strong> Hora de entrada y salida establecida</li>
                                <li><span class="fa-li"><i class="fas fa-check-circle text-primary"></i></span><strong>Tolerancia:</strong> Minutos de gracia para el registro</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary"><i class="fas fa-calendar-alt mr-2"></i>Días Laborales</h6>
                            <p>Los días marcados con <i class="fas fa-check-circle text-success"></i> son tus días de trabajo.</p>
                            <p>Para solicitar cambios:</p>
                            <ol>
                                <li>Haz clic en "Solicitar Cambio de Horario"</li>
                                <li>Completa el formulario</li>
                                <li>Espera la aprobación de Recursos Humanos</li>
                            </ol>
                        </div>
                    </div>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Los cambios de horario requieren aprobación y pueden tomar hasta 48 horas en procesarse.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-file-alt mr-2"></i>Ver Política Completa
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Estilos generales */
        .card {
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .card-header {
            border-radius: 0.75rem 0.75rem 0 0 !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .bg-primary-light {
            background-color: #f8f9fc;
        }

        /* Estilos para la información del empleado */
        .avatar-lg {
            width: 80px;
            height: 80px;
        }

        /* Estilos para las tarjetas de horario */
        .schedule-card {
            transition: all 0.3s ease;
            border-left: 4px solid #4e73df;
        }

        .schedule-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Estilos para los días laborales */
        .day-item {
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .day-working {
            background-color: #e8f4fd;
        }

        .day-off {
            background-color: #f8f9fa;
        }

        /* Estilos para el calendario */
        #scheduleCalendar {
            min-height: 400px;
        }

        .legend-color {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 3px;
        }

        .working-day {
            background-color: #1cc88a;
        }

        .day-off {
            background-color: #e74a3b;
        }

        .holiday {
            background-color: #f6c23e;
        }

        /* Estilos para las pestañas */
        .nav-tabs .nav-link {
            border: none;
            color: #6e707e;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
        }

        .nav-tabs .nav-link.active {
            color: #4e73df;
            background-color: transparent;
            border-bottom: 3px solid #4e73df;
        }

        /* Efectos hover */
        .btn-shadow {
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .btn-shadow:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .avatar-lg {
                width: 60px;
                height: 60px;
            }

            .nav-tabs .nav-link {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Botón de impresión
            $('#printSchedule').click(function() {
                window.print();
            });

            // Botón de refrescar
            $('#refreshSchedule').click(function(e) {
                e.preventDefault();
                location.reload();
            });

            // Inicialización básica del calendario (sin FullCalendar para evitar errores)
            $('#calendar-tab').on('click', function() {
                alert('Funcionalidad de calendario completo disponible en versión premium');
            });

            // Descargar PDF
            $('#downloadSchedule').click(function() {
                alert('Generando PDF... Esta funcionalidad requiere la librería jsPDF');
            });
        });
    </script>
@endsection
