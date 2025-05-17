@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-file-alt mr-2"></i>Detalle de Justificación
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.justificaciones.index') }}" class="text-white-50">Justificaciones</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Detalle</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow-sm text-primary">
                <i class="fas fa-calendar-day mr-1"></i> {{ $justificacion->fecha->format('d/m/Y') }}
            </span>
            </div>
        </div>

        <!-- Tarjeta Principal -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Información de la Justificación
                </h6>
                <a href="{{ route('adminn.justificaciones.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </div>

            <div class="card-body">
                <!-- Sección de Información Básica -->
                <div class="row mb-5">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar-lg mr-4">
                                    <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                        {{ substr($justificacion->empleado->nombre, 0, 1) }}{{ substr($justificacion->empleado->apellido_paterno, 0, 1) }}
                                    </span>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 font-weight-bold">{{ $justificacion->empleado->nombre_completo }}</h5>
                                        <p class="mb-0 text-muted">
                                            <i class="fas fa-id-card mr-2"></i>{{ $justificacion->empleado->puesto->nombre_puesto ?? 'Sin puesto asignado' }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="text-muted small font-weight-bold">Estado</h6>
                                        <span class="badge badge-pill
                                        @if($justificacion->estado->ID_estado == 2) badge-success
                                        @elseif($justificacion->estado->ID_estado == 3) badge-danger
                                        @else badge-warning @endif">
                                        {{ $justificacion->estado->nombre_estado }}
                                    </span>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="text-muted small font-weight-bold">Registrado el</h6>
                                        <p class="mb-0">{{ $justificacion->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="font-weight-bold mb-4"><i class="fas fa-calendar-day mr-2 text-primary"></i>Detalles de la Ausencia</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted small font-weight-bold">Fecha de Ausencia</h6>
                                        <p class="font-weight-bold">{{ $justificacion->fecha->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted small font-weight-bold">Tipo de Justificación</h6>
                                        <p class="font-weight-bold">{{ $justificacion->tipoJustificacion->nombre_tipo ?? 'No especificado' }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-muted small font-weight-bold">Adjuntos</h6>
                                        @isset($justificacion->archivos)
                                            @if($justificacion->archivos->count() > 0)
                                                <div class="d-flex flex-wrap">
                                                    @foreach($justificacion->archivos as $archivo)
                                                        <a href="{{ asset('storage/' . $archivo->ruta) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-primary rounded-pill mr-2 mb-2">
                                                            <i class="fas fa-paperclip mr-1"></i> Documento {{ $loop->iteration }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-muted mb-0"><i class="fas fa-info-circle mr-1"></i> No hay archivos adjuntos</p>
                                            @endif
                                        @else
                                            <p class="text-muted mb-0"><i class="fas fa-info-circle mr-1"></i> No hay información de archivos</p>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección de Motivo -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light-primary py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-comment-alt mr-2"></i>Motivo de la Justificación
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-soft-primary rounded">
                            {!! nl2br(e($justificacion->motivo)) !!}
                        </div>
                    </div>
                </div>

                <!-- Sección de Comentario Administrador -->
                @if($justificacion->comentario_admin)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light-primary py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-user-shield mr-2"></i>Comentario del Administrador
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="p-3 bg-soft-primary rounded">
                                {!! nl2br(e($justificacion->comentario_admin)) !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Sección de Acciones -->
                @if($justificacion->estado->ID_estado == 1)
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="font-weight-bold mb-4 text-primary"><i class="fas fa-tasks mr-2"></i>Acciones</h5>
                        <div class="d-flex justify-content-end">
                            <form method="POST" action="{{ route('adminn.justificaciones.estado', $justificacion->ID_justificacion) }}" class="mr-3">
                                @csrf
                                <input type="hidden" name="estado" value="3">
                                <button type="submit" class="btn btn-danger rounded-pill shadow-sm px-4">
                                    <i class="fas fa-times mr-2"></i> Rechazar Justificación
                                </button>
                            </form>

                            <button type="button" class="btn btn-success rounded-pill shadow-sm px-4" data-toggle="modal" data-target="#aprobarModal">
                                <i class="fas fa-check mr-2"></i> Aprobar Justificación
                            </button>
                        </div>
                    </div>

                    <!-- Modal para Aprobar -->
                    <div class="modal fade" id="aprobarModal" tabindex="-1" role="dialog" aria-labelledby="aprobarModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="aprobarModalLabel">Aprobar Justificación</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('adminn.justificaciones.estado', $justificacion->ID_justificacion) }}">
                                    @csrf
                                    <input type="hidden" name="estado" value="2">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="comentario_admin" class="font-weight-bold">Comentario (Opcional)</label>
                                            <textarea class="form-control" id="comentario_admin" name="comentario_admin" rows="3" placeholder="Puede agregar un comentario adicional"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary rounded-pill">Confirmar Aprobación</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Estilos CSS Personalizados -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .bg-light-primary {
            background-color: rgba(78, 115, 223, 0.1);
        }
        .bg-soft-primary {
            background-color: rgba(78, 115, 223, 0.08);
        }
        .avatar-lg {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            font-size: 1.25rem;
        }
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Tooltips
                $('[data-toggle="tooltip"]').tooltip();

                // Validación del formulario de aprobación
                $('#aprobarModal form').submit(function(e) {
                    // Puedes agregar validación adicional aquí si es necesario
                    return true;
                });
            });
        </script>
    @endsection
@endsection
