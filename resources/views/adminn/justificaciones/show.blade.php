@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt mr-2"></i>Detalle de Justificación
                    </h5>
                    <a href="{{ route('adminn.justificaciones.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Empleado</h6>
                        <p>{{ $justificacion->empleado->nombre_completo }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha de Ausencia</h6>
                        <p>{{ $justificacion->fecha->format('d/m/Y') }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <h6 class="text-muted">Motivo</h6>
                    <div class="border p-3 rounded bg-light">
                        {{ $justificacion->motivo }}
                    </div>
                </div>

                @if($justificacion->comentario_admin)
                    <div class="form-group">
                        <h6 class="text-muted">Comentario del Administrador</h6>
                        <div class="border p-3 rounded bg-light">
                            {{ $justificacion->comentario_admin }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
