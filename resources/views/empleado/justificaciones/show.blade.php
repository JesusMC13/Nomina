@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt mr-2"></i>Detalle de Justificación
                    </h5>
                    <a href="{{ route('empleado.justificaciones.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <h6 class="text-muted">Fecha de ausencia</h6>
                        <p>{{ $justificacion->fecha->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Estado</h6>
                        <span class="badge
                        @if($justificacion->estado->nombre_estado == 'Aprobado') badge-success
                        @elseif($justificacion->estado->nombre_estado == 'Rechazado') badge-danger
                        @else badge-warning @endif">
                        {{ $justificacion->estado->nombre_estado }}
                    </span>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Fecha de registro</h6>
                        <p>{{ $justificacion->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <h6 class="text-muted">Motivo</h6>
                    <div class="border p-3 rounded bg-light">
                        {{ $justificacion->motivo }}
                    </div>
                </div>

                @if($justificacion->comentario_admin)
                    <div class="form-group mt-4">
                        <h6 class="text-muted">Respuesta del administrador</h6>
                        <div class="border p-3 rounded bg-light">
                            {{ $justificacion->comentario_admin }}
                        </div>
                    </div>
                @endif

                @if($justificacion->archivo)
                    <div class="form-group mt-4">
                        <h6 class="text-muted">Archivo adjunto</h6>
                        <a href="{{ asset('storage/'.$justificacion->archivo) }}"
                           target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-file-download mr-1"></i> Descargar archivo
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
