@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('empleado.descuentos.index') }}" class="btn btn-light btn-sm mr-2" title="Regresar">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h3 class="mb-0 d-inline-block"><i class="fas fa-file-invoice-dollar mr-2"></i> Detalle de Descuento</h3>
                    </div>
                    <span class="badge bg-light text-dark">
                        {{ $descuento->empleado->nombre }} {{ $descuento->empleado->apellido_paterno }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="text-primary">Información General</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Fecha:</strong> {{ $descuento->fecha->format('d/m/Y') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Tipo:</strong> {{ ucfirst($descuento->tipo_descuento) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Monto:</strong>
                                <span class="text-danger">-${{ number_format($descuento->monto, 2) }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-primary">Detalles</h5>
                        <div class="card">
                            <div class="card-body">
                                @if(isset($descuento->es_calculado) && $descuento->es_calculado)
                                    <p class="mb-1"><strong>Origen:</strong> Retardo en asistencia</p>
                                    <p class="mb-1"><strong>Minutos de retardo:</strong> {{ $descuento->minutos_retraso }}</p>
                                    <p class="mb-1"><strong>Cálculo:</strong>
                                        {{ App\Http\Controllers\DescuentosController::generarDetalleCalculo(
                                            $descuento->empleado,
                                            $descuento->minutos_retraso,
                                            $descuento->monto
                                        ) }}
                                    </p>
                                @else
                                    <p>{{ $descuento->comentarios ?? 'Sin detalles adicionales' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($descuento->asistencia))
                    <div class="alert alert-info">
                        <h5><i class="fas fa-clock mr-2"></i> Detalles de Asistencia</h5>
                        <ul class="mb-0">
                            <li>Hora esperada: {{ $descuento->asistencia->hora_esperada ?? 'N/A' }}</li>
                            <li>Hora de llegada: {{ $descuento->asistencia->hora_inicio ?? 'N/A' }}</li>
                            <li>Minutos de retardo: {{ $descuento->asistencia->minutos_retraso ?? 0 }}</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
