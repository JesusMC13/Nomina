@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">
                    <i class="fas fa-file-alt mr-2"></i> Detalle del Reporte de Nómina
                </h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Fecha del Reporte:</strong> {{ $reporte->fecha_reporte->format('d/m/Y') }}</p>
                        <p><strong>Total Nómina:</strong> ${{ number_format($reporte->total_nomina, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Generado por:</strong> {{ $reporte->creador->name ?? 'N/A' }}</p>
                        <p><strong>Empleados incluidos:</strong> {{ $reporte->total_empleados }}</p>
                    </div>
                </div>

                <h4 class="mb-3">Detalles por Empleado</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                        <tr>
                            <th>Empleado</th>
                            <th>Puesto</th>
                            <th>Sueldo Diario</th>
                            <th>Días Trabajados</th>
                            <th>Descuentos</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle['nombre'] ?? 'N/A' }}</td>
                                <td>{{ $detalle['puesto'] ?? 'N/A' }}</td>
                                <td>${{ number_format($detalle['sueldo_diario'] ?? 0, 2) }}</td>
                                <td>{{ $detalle['dias_trabajados'] ?? 0 }}</td>
                                <td>${{ number_format($detalle['descuentos'] ?? 0, 2) }}</td>
                                <td>${{ number_format($detalle['pago_total'] ?? 0, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay detalles disponibles</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('adminn.reportes.ver') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i> Volver a Reportes
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
