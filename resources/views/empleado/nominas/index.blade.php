@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <!-- Encabezado -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-sm btn-light mr-2">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h5 class="mb-0 d-inline-block">
                                <i class="fas fa-file-invoice-dollar mr-2"></i>Mis Nóminas Semanales
                            </h5>
                        </div>
                        <a href="#" class="btn btn-sm btn-light" data-toggle="modal" data-target="#helpModal">
                            <i class="fas fa-question-circle"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <!-- Versión móvil -->
                        <div class="d-block d-lg-none mb-4">
                            @if($nominas->isEmpty())
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    No tienes nóminas registradas.
                                </div>
                            @else
                                @foreach($nominas as $nomina)
                                    <div class="card mb-3 shadow-sm border-left-primary">
                                        <div class="card-body">
                                            <h6 class="font-weight-bold text-primary">
                                                Semana: {{ $nomina->fecha_inicio->format('d/m') }} - {{ $nomina->fecha_fin->format('d/m/Y') }}
                                            </h6>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <small class="text-muted">Días:</small>
                                                    <p>{{ $nomina->dias_trabajados }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Diario:</small>
                                                    <p>${{ number_format($sueldoDiario, 2) }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <small class="text-muted">Bruto:</small>
                                                    <p>${{ number_format($nomina->sueldo_base, 2) }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Descuentos:</small>
                                                    <p class="text-danger">
                                                        -${{ number_format($nomina->total_descuentos, 2) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <small class="text-muted">Neto:</small>
                                                    <h5 class="font-weight-bold text-success">
                                                        ${{ number_format($nomina->sueldo_neto, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="text-center mt-2">
                                                <a href="{{ route('empleado.nominas.show', $nomina->id) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye mr-1"></i> Detalle
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Versión desktop -->
                        <div class="d-none d-lg-block">
                            @if($nominas->isEmpty())
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    No tienes nóminas registradas.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="bg-light-primary">
                                        <tr>
                                            <th><i class="fas fa-calendar-week mr-2"></i>Semana</th>
                                            <th><i class="fas fa-calendar-day mr-2"></i>Días</th>
                                            <th><i class="fas fa-money-bill-wave mr-2"></i>Diario</th>
                                            <th><i class="fas fa-coins mr-2"></i>Bruto</th>
                                            <th><i class="fas fa-minus-circle mr-2"></i>Descuentos</th>
                                            <th><i class="fas fa-hand-holding-usd mr-2"></i>Neto</th>
                                            <th><i class="fas fa-cog mr-2"></i>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($nominas as $nomina)
                                            <tr>
                                                <td>{{ $nomina->fecha_inicio->format('d/m') }} - {{ $nomina->fecha_fin->format('d/m/Y') }}</td>
                                                <td class="text-center">
                                                <span class="badge badge-primary">
                                                    {{ $nomina->dias_trabajados }}
                                                </span>
                                                </td>
                                                <td>${{ number_format($sueldoDiario, 2) }}</td>
                                                <td class="text-success">${{ number_format($nomina->sueldo_base, 2) }}</td>
                                                <td class="text-danger">-${{ number_format($nomina->total_descuentos, 2) }}</td>
                                                <td class="font-weight-bold text-success">${{ number_format($nomina->sueldo_neto, 2) }}</td>
                                                <td>
                                                    <a href="{{ route('empleado.nominas.show', $nomina->id) }}"
                                                       class="btn btn-sm btn-primary"
                                                       title="Ver detalle">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-outline-secondary"
                                                            onclick="window.print()"
                                                            title="Imprimir">
                                                        <i class="fas fa-print"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        <!-- Paginación -->
                        @if($nominas->isNotEmpty())
                            <div class="mt-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small">
                                        Mostrando {{ $nominas->firstItem() }} - {{ $nominas->lastItem() }} de {{ $nominas->total() }} registros
                                    </div>
                                    <div>
                                        {{ $nominas->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer text-muted small">
                        <i class="fas fa-info-circle mr-1"></i>
                        Sistema de nóminas - {{ date('d/m/Y') }}
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
                        <i class="fas fa-question-circle mr-2"></i>Ayuda sobre nóminas
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Esta sección muestra tu historial de nóminas semanales:</p>
                    <ul>
                        <li><strong>Semana:</strong> Periodo de pago</li>
                        <li><strong>Días:</strong> Días trabajados en la semana</li>
                        <li><strong>Bruto:</strong> Salario antes de descuentos</li>
                        <li><strong>Neto:</strong> Salario después de descuentos</li>
                    </ul>
                    <p class="mb-0">Para detalles completos, haz clic en el botón <i class="fas fa-eye"></i> de cada nómina.</p>
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
        .border-left-primary {
            border-left: 4px solid #007bff;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(function () {
            // Inicializar tooltips
            $('[title]').tooltip();
        });
    </script>
@endsection
