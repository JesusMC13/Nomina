@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('empleado.nominas.index') }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h3 class="d-inline-block mb-0"><i class="fas fa-file-invoice me-2"></i>Detalle de Nómina</h3>

            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Información del Periodo</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Empleado:</strong> {{ $nomina->empleado->nombre_completo }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Periodo:</strong> {{ $nomina->periodo }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Estado:</strong>
                                        <span class="badge bg-{{ $nomina->estado_color }}">
                                        {{ ucfirst($nomina->estado) }}
                                    </span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Fecha de pago:</strong>
                                        {{ optional($nomina->fecha_pago)->format('d/m/Y') ?? 'Pendiente' }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Resumen Financiero</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tbody>
                                        <tr>
                                            <td><strong>Sueldo Base</strong></td>
                                            <td class="text-end">${{ number_format($nomina->sueldo_base, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Horas Extras</strong></td>
                                            <td class="text-end">${{ number_format($nomina->horas_extras, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Bonificaciones</strong></td>
                                            <td class="text-end">${{ number_format($nomina->bonificaciones, 2) }}</td>
                                        </tr>
                                        <tr class="table-success">
                                            <td><strong>Total Bruto</strong></td>
                                            <td class="text-end">${{ number_format($nomina->sueldo_bruto, 2) }}</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td><strong>Total Descuentos</strong></td>
                                            <td class="text-end">-${{ number_format($nomina->total_descuentos, 2) }}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td><strong>Sueldo Neto</strong></td>
                                            <td class="text-end">${{ number_format($nomina->sueldo_neto, 2) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Detalle de Descuentos</h5>
                    </div>
                    <div class="card-body">
                        @if($nomina->descuentos->isEmpty())
                            <div class="alert alert-info mb-0">No se aplicaron descuentos en este periodo.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Concepto</th>
                                        <th class="text-end">Monto</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($nomina->descuentos as $descuento)
                                        <tr>
                                            <td>{{ $descuento->fecha->format('d/m/Y') }}</td>
                                            <td>{{ ucfirst($descuento->tipo_descuento) }}</td>
                                            <td>{{ $descuento->comentarios ?? 'Sin descripción' }}</td>
                                            <td class="text-danger text-end">-${{ number_format($descuento->monto, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="table-danger">
                                        <td colspan="3" class="text-end"><strong>Total Descuentos:</strong></td>
                                        <td class="text-end">-${{ number_format($nomina->total_descuentos, 2) }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
