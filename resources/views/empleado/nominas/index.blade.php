@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>
                        Mis Nóminas Semanales
                    </h5>
                    <a href="{{ route('empleado.dashboard') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Regresar
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if($nominas->isEmpty())
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle mr-2"></i>
                        No tienes nóminas registradas. Contacta a Recursos Humanos si crees que esto es un error.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Semana</th>
                                <th>Días</th>
                                <th>Diario</th>
                                <th>Bruto</th>
                                <th>Descuentos</th>
                                <th>Neto</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($nominas as $nomina)
                                <tr>
                                    <td>{{ $nomina->fecha_inicio->format('d/m') }} - {{ $nomina->fecha_fin->format('d/m/Y') }}</td>
                                    <td>{{ $nomina->dias_trabajados }}</td>
                                    <td>${{ number_format($sueldoDiario, 2) }}</td>
                                    <td>${{ number_format($nomina->sueldo_base, 2) }}</td>
                                    <td class="text-danger">
                                        @if($nomina->descuentos->isNotEmpty())
                                            <a href="#" data-toggle="modal" data-target="#descuentosModal{{ $nomina->id }}">
                                                -${{ number_format($nomina->total_descuentos, 2) }}
                                            </a>
                                        @else
                                            -$0.00
                                        @endif
                                    </td>
                                    <td class="font-weight-bold">${{ number_format($nomina->sueldo_neto, 2) }}</td>
                                    <td>
                                        <a href="{{ route('empleado.nominas.show', $nomina) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detalle
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal para descuentos -->
                                @if($nomina->descuentos->isNotEmpty())
                                    <div class="modal fade" id="descuentosModal{{ $nomina->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detalle de Descuentos</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        @foreach($nomina->descuentos as $descuento)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                {{ $descuento->comentarios }}
                                                                <span class="badge badge-danger badge-pill">
                                                        -${{ number_format($descuento->monto, 2) }}
                                                    </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <p class="text-muted small">
                            <i class="fas fa-info-circle"></i>
                            Salario semanal: ${{ number_format($sueldoSemanal, 2) }}
                            ({{ number_format($sueldoDiario, 2) }}/día)
                        </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $nominas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
