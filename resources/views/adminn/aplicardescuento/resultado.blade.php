@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-clock mr-2"></i>Resumen de Descuentos por Retardos
                    </h3>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-primary h-100">
                            <div class="card-body">
                                <h5 class="font-weight-bold text-primary mb-4">
                                    <i class="fas fa-calendar-alt mr-2"></i>Periodo
                                </h5>
                                <div class="pl-3">
                                    <p class="mb-3">
                                        <span class="font-weight-bold text-muted">Fecha Inicio:</span><br>
                                        <span class="h5 text-dark">{{ \Carbon\Carbon::parse($fechaInicio)->format('d M, Y') }}</span>
                                    </p>
                                    <p>
                                        <span class="font-weight-bold text-muted">Fecha Fin:</span><br>
                                        <span class="h5 text-dark">{{ \Carbon\Carbon::parse($fechaFin)->format('d M, Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card border-left-primary h-100">
                            <div class="card-body">
                                <h5 class="font-weight-bold text-primary mb-4">
                                    <i class="fas fa-chart-pie mr-2"></i>Resumen General
                                </h5>
                                <div class="pl-3">
                                    <p class="mb-3">
                                        <span class="font-weight-bold text-muted">Total Empleados:</span><br>
                                        <span class="h5 text-dark">{{ $resumen->total_empleados }}</span>
                                    </p>
                                    <p class="mb-3">
                                        <span class="font-weight-bold text-muted">Total Retardos:</span><br>
                                        <span class="h5 text-dark">{{ $resumen->total_retardos }}</span>
                                    </p>
                                    <p class="mb-3">
                                        <span class="font-weight-bold text-muted">Minutos de Retraso:</span><br>
                                        <span class="h5 text-dark">{{ $resumen->total_minutos_retraso }} min</span>
                                    </p>
                                    <p>
                                        <span class="font-weight-bold text-muted">Total Descuentos:</span><br>
                                        <span class="h5 text-primary">${{ number_format($resumen->total_descuentos, 2) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('adminn.aplicardescuento.index') }}" class="btn btn-primary btn-lg rounded-pill shadow-sm px-4">
                        <i class="fas fa-arrow-left mr-2"></i> Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-header {
            border-radius: 0.35rem 0.35rem 0 0 !important;
        }
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }
        .card {
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
    </style>
@endsection
