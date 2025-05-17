@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <!-- Encabezado con estilo consistente -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-sm btn-light mr-2">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h5 class="mb-0 d-inline-block">
                                <i class="fas fa-clipboard-check mr-2"></i>Mis Asistencias
                            </h5>
                        </div>
                        <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#helpModal">
                            <i class="fas fa-question-circle"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <!-- Botón de regreso para móviles -->
                        <div class="d-block d-md-none mb-3">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-arrow-left mr-2"></i>Regresar al Dashboard
                            </a>
                        </div>

                        <!-- Botón principal flotante para desktop -->
                        <div class="d-none d-md-block text-right mb-4">
                            <a href="{{ route('empleado.asistencias.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus-circle mr-2"></i>Registrar Asistencia
                            </a>
                        </div>

                        <!-- Botón para móviles -->
                        <div class="d-block d-md-none mb-4">
                            <a href="{{ route('empleado.asistencias.create') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-plus-circle mr-2"></i>Registrar Asistencia
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Tabla mejorada -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-light-primary">
                                <tr>
                                    <th class="text-center"><i class="fas fa-calendar-day mr-2"></i>Fecha</th>
                                    <th class="text-center"><i class="fas fa-sign-in-alt mr-2"></i>Entrada</th>
                                    <th class="text-center"><i class="fas fa-sign-out-alt mr-2"></i>Salida</th>
                                    <th class="text-center"><i class="fas fa-cog mr-2"></i>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($asistencias as $asistencia)
                                    <tr>
                                        <td class="text-center align-middle">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                                        <td class="text-center align-middle">
                                        <span class="badge badge-success p-2">
                                            {{ \Carbon\Carbon::parse($asistencia->hora_inicio)->format('h:i A') }}
                                        </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($asistencia->hora_fin)
                                                <span class="badge badge-danger p-2">
                                                {{ \Carbon\Carbon::parse($asistencia->hora_fin)->format('h:i A') }}
                                            </span>
                                            @else
                                                <span class="badge badge-warning p-2">Pendiente</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center">
                                                @if(!$asistencia->hora_fin)
                                                    <a href="{{ route('empleado.asistencias.edit', $asistencia->ID_asistencia) }}"
                                                       class="btn btn-sm btn-primary mr-2"
                                                       data-toggle="tooltip" title="Registrar salida">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                <form action="{{ route('empleado.asistencias.destroy', $asistencia->ID_asistencia) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            data-toggle="tooltip" title="Eliminar registro"
                                                            onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer text-muted small d-flex justify-content-between">
                        <div>
                            <i class="fas fa-info-circle mr-1"></i>
                            Mostrando {{ $asistencias->count() }} registros
                        </div>
                        <div>
                            Última actualización: {{ now()->format('d/m/Y H:i') }}
                        </div>
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
                        <i class="fas fa-question-circle mr-2"></i>Ayuda sobre asistencias
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Esta sección muestra tu historial de asistencias:</p>
                    <ul>
                        <li><strong>Fecha:</strong> Día del registro</li>
                        <li><strong>Entrada:</strong> Hora de inicio de tu jornada</li>
                        <li><strong>Salida:</strong> Hora de fin de tu jornada (o pendiente si no está registrada)</li>
                        <li><strong>Acciones:</strong> Puedes editar o eliminar registros</li>
                    </ul>
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-lightbulb mr-2"></i>
                        Recuerda registrar tu salida al finalizar tu jornada laboral.
                    </div>
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
        .bg-light-primary {
            background-color: #e3f2fd;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }
        .badge {
            font-size: 0.85em;
            min-width: 80px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
