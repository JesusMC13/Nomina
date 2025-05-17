@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <!-- Encabezado mejorado -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-light btn-sm mr-3" title="Regresar al dashboard">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h3 class="mb-0"><i class="fas fa-file-invoice-dollar mr-2"></i> Mis Descuentos</h3>
                                <small class="d-block opacity-75">Historial completo de descuentos aplicados</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="mr-3 text-right d-none d-md-block">
                                <small class="d-block">Total descuentos:</small>
                                <span class="h5 mb-0 text-danger">-${{ number_format($descuentos->sum('monto'), 2) }}</span>
                            </div>
                            <span class="badge bg-light text-dark p-2">
                            <i class="fas fa-user-circle mr-1"></i>
                            {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}
                        </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Botón de regreso para móviles -->
                        <div class="d-block d-md-none mb-4">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-arrow-left mr-2"></i> Regresar
                            </a>
                        </div>

                        <!-- Resumen para móviles -->
                        <div class="d-block d-md-none mb-4 bg-light p-3 rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Total descuentos:</small>
                                    <h5 class="mb-0 text-danger">-${{ number_format($descuentos->sum('monto'), 2) }}</h5>
                                </div>
                                <div>
                                    <small class="text-muted">Registros:</small>
                                    <h5 class="mb-0">{{ $descuentos->count() }}</h5>
                                </div>
                            </div>
                        </div>

                        @if($descuentos->isEmpty())
                            <div class="alert alert-success">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle fa-2x mr-3 text-success"></i>
                                    <div>
                                        <h5 class="mb-1">¡Excelente!</h5>
                                        <p class="mb-0">No tienes descuentos registrados en tu historial.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Filtros y búsqueda -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-search"></i>
                                    </span>
                                        <input type="text" class="form-control" placeholder="Buscar descuentos..." id="searchInput">
                                    </div>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <button class="btn btn-outline-primary btn-block" id="resetFilters">
                                        <i class="fas fa-sync-alt mr-1"></i> Limpiar
                                    </button>
                                </div>
                            </div>

                            <!-- Versión móvil -->
                            <div class="d-block d-lg-none">
                                @foreach($descuentos as $descuento)
                                    <div class="card mb-3 border-left-{{ $descuento->tipo_descuento === 'retardo' ? 'warning' : 'danger' }} shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1 text-{{ $descuento->tipo_descuento === 'retardo' ? 'warning' : 'danger' }}">
                                                        -${{ number_format($descuento->monto, 2) }}
                                                    </h5>
                                                    <p class="mb-1"><small>{{ $descuento->fecha->format('d/m/Y') }}</small></p>
                                                </div>
                                                <span class="badge bg-{{ $descuento->tipo_descuento === 'retardo' ? 'warning' : 'danger' }} text-dark">
                                            {{ ucfirst($descuento->tipo_descuento) }}
                                        </span>
                                            </div>
                                            <p class="mb-2 mt-2">
                                                @if($descuento->minutos_retraso)
                                                    <span class="badge bg-warning text-dark">
                                                <i class="fas fa-clock mr-1"></i> Retardo: {{ $descuento->minutos_retraso }} min
                                            </span>
                                                @else
                                                    <i class="fas fa-comment-alt mr-1 text-muted"></i>
                                                    {{ Str::limit($descuento->comentarios, 50) }}
                                                @endif
                                            </p>
                                            <div class="d-flex justify-content-end mt-2">
                                                <a href="{{ route('empleado.descuentos.show', $descuento->ID_descuento) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye mr-1"></i> Detalles
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Versión desktop -->
                            <div class="d-none d-lg-block">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" id="descuentosTable">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th class="text-nowrap"><i class="fas fa-calendar-day mr-2"></i>Fecha</th>
                                            <th class="text-nowrap"><i class="fas fa-tag mr-2"></i>Tipo</th>
                                            <th class="text-nowrap"><i class="fas fa-money-bill-wave mr-2"></i>Monto</th>
                                            <th><i class="fas fa-info-circle mr-2"></i>Detalle</th>
                                            <th class="text-nowrap"><i class="fas fa-cog mr-2"></i>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($descuentos as $descuento)
                                            <tr class="hover-shadow">
                                                <td class="align-middle">
                                                <span class="badge bg-light text-dark">
                                                    {{ $descuento->fecha->format('d/m/Y') }}
                                                </span>
                                                </td>
                                                <td class="align-middle">
                                                <span class="badge badge-{{ $descuento->tipo_descuento === 'retardo' ? 'warning' : 'danger' }} p-2">
                                                    <i class="fas fa-{{ $descuento->tipo_descuento === 'retardo' ? 'clock' : ($descuento->tipo_descuento === 'falta' ? 'user-times' : 'hand-holding-usd') }} mr-1"></i>
                                                    {{ ucfirst($descuento->tipo_descuento) }}
                                                </span>
                                                </td>
                                                <td class="align-middle text-danger fw-bold">-${{ number_format($descuento->monto, 2) }}</td>
                                                <td class="align-middle">
                                                    @if($descuento->minutos_retraso)
                                                        <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock mr-1"></i> Retardo: {{ $descuento->minutos_retraso }} min
                                                    </span>
                                                    @else
                                                        <i class="fas fa-comment-alt mr-1 text-muted"></i>
                                                        {{ $descuento->comentarios }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex">
                                                        <a href="{{ route('empleado.descuentos.show', $descuento->ID_descuento) }}"
                                                           class="btn btn-sm btn-primary me-2"
                                                           title="Ver detalles"
                                                           data-bs-toggle="tooltip">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-outline-secondary"
                                                                onclick="window.print()"
                                                                title="Imprimir comprobante"
                                                                data-bs-toggle="tooltip">
                                                            <i class="fas fa-print"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Paginación y resumen -->
                            <div class="mt-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Mostrando {{ $descuentos->firstItem() }} - {{ $descuentos->lastItem() }} de {{ $descuentos->total() }} descuentos
                                    </div>
                                    <div>
                                        {{ $descuentos->onEachSide(1)->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Última actualización: {{ now()->format('d/m/Y H:i') }}
                            </small>
                            <small>
                                <i class="fas fa-question-circle mr-1"></i>
                                Para aclaraciones, contacta a Recursos Humanos
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de ayuda -->
    <div class="modal fade" id="helpModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle mr-2"></i>Ayuda sobre descuentos
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary"><i class="fas fa-info-circle mr-2"></i>Tipos de descuentos</h6>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-warning me-3"><i class="fas fa-clock"></i></span>
                                        <div>
                                            <h6 class="mb-1">Retardos</h6>
                                            <small class="text-muted">Calculado automáticamente por minutos de retraso</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-danger me-3"><i class="fas fa-user-times"></i></span>
                                        <div>
                                            <h6 class="mb-1">Faltas</h6>
                                            <small class="text-muted">Deducción por día completo no trabajado</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-info me-3"><i class="fas fa-hand-holding-usd"></i></span>
                                        <div>
                                            <h6 class="mb-1">Préstamos</h6>
                                            <small class="text-muted">Deducción programada de préstamos</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary"><i class="fas fa-lightbulb mr-2"></i>Consejos</h6>
                            <div class="alert alert-light border-primary">
                                <div class="d-flex mb-3">
                                    <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">Verificación periódica</h6>
                                        <p class="mb-0 small">Revisa tus descuentos regularmente para asegurar su exactitud</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <i class="fas fa-exclamation-triangle text-warning me-3 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">Aclaraciones</h6>
                                        <p class="mb-0 small">Reporta cualquier inconsistencia inmediatamente a RRHH</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <i class="fas fa-print text-info me-3 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1">Registro físico</h6>
                                        <p class="mb-0 small">Puedes imprimir tus descuentos para mantener un respaldo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="fas fa-check mr-1"></i> Entendido
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 0.5rem;
            border: none;
        }
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
        .border-left-warning {
            border-left: 4px solid #ffc107 !important;
        }
        .border-left-danger {
            border-left: 4px solid #dc3545 !important;
        }
        .table-hover tbody tr {
            transition: all 0.2s ease;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .badge {
            font-weight: 500;
        }
        .form-select, .form-control {
            border-radius: 0.375rem;
        }
        .input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Filtrado por tipo
            document.getElementById('filterType').addEventListener('change', function() {
                const type = this.value.toLowerCase();
                const rows = document.querySelectorAll('#descuentosTable tbody tr');

                rows.forEach(row => {
                    const rowType = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    row.style.display = (type === '' || rowType.includes(type)) ? '' : 'none';
                });
            });

            // Búsqueda general
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const searchText = this.value.toLowerCase();
                const rows = document.querySelectorAll('#descuentosTable tbody tr');

                rows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchText) ? '' : 'none';
                });
            });

            // Resetear filtros
            document.getElementById('resetFilters').addEventListener('click', function() {
                document.getElementById('searchInput').value = '';
                document.getElementById('filterType').value = '';
                const rows = document.querySelectorAll('#descuentosTable tbody tr');
                rows.forEach(row => row.style.display = '');
            });
        });
    </script>
@endsection
