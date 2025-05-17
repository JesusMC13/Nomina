@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg">
                    <!-- Encabezado mejorado -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-sm btn-light mr-3">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h4 class="mb-0"><i class="fas fa-file-alt mr-2"></i>Mis Justificaciones</h4>
                                <small class="d-block opacity-75">Historial de justificaciones enviadas</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#formJustificacion">
                            <i class="fas fa-plus mr-1"></i> Nueva Justificación
                        </button>
                    </div>

                    <div class="card-body">
                        <!-- Botón de regreso para móviles -->
                        <div class="d-block d-md-none mb-4">
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-arrow-left mr-2"></i> Regresar
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle fa-2x mr-3"></i>
                                    <div>
                                        <h5 class="mb-1">¡Justificación enviada!</h5>
                                        <p class="mb-0">{{ session('success') }}</p>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Formulario Colapsable Mejorado -->
                        <div class="collapse mb-4 @if($errors->any()) show @endif" id="formJustificacion">
                            <div class="card card-body border-primary">
                                <h5 class="card-title text-primary mb-4">
                                    <i class="fas fa-pen-alt mr-2"></i>Nueva Justificación
                                </h5>
                                <form method="POST" action="{{ route('empleado.justificaciones.store') }}" id="justificacionForm">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fecha" class="form-label">Fecha *</label>
                                            <div class="input-group">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-calendar-day"></i>
                                            </span>
                                                <input type="date" class="form-control @error('fecha') is-invalid @enderror"
                                                       id="fecha" name="fecha" required max="{{ date('Y-m-d') }}"
                                                       value="{{ old('fecha') }}">
                                                @error('fecha')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="text-muted">Selecciona la fecha a justificar</small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="motivo" class="form-label">Motivo *</label>
                                        <textarea class="form-control @error('motivo') is-invalid @enderror"
                                                  id="motivo" name="motivo" rows="4" required
                                                  placeholder="Describe detalladamente el motivo de tu justificación...">{{ old('motivo') }}</textarea>
                                        @error('motivo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Mínimo 30 caracteres</small>
                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-outline-secondary me-2"
                                                data-bs-toggle="collapse" data-bs-target="#formJustificacion">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-paper-plane mr-1"></i> Enviar Justificación
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Listado de Justificaciones -->
                        @if($justificaciones->isEmpty())
                            <div class="alert alert-info">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x mr-3"></i>
                                    <div>
                                        <h5 class="mb-1">No hay justificaciones</h5>
                                        <p class="mb-0">No has enviado ninguna justificación aún.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Filtros -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-search"></i>
                                    </span>
                                        <input type="text" class="form-control" placeholder="Buscar justificaciones..." id="searchInput">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <select class="form-select" id="filterStatus">
                                        <option value="">Todos los estados</option>
                                        <option value="Pendiente">Pendientes</option>
                                        <option value="Aprobado">Aprobadas</option>
                                        <option value="Rechazado">Rechazadas</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button class="btn btn-outline-primary btn-block" id="resetFilters">
                                        <i class="fas fa-sync-alt mr-1"></i> Limpiar
                                    </button>
                                </div>
                            </div>

                            <!-- Versión móvil -->
                            <div class="d-block d-lg-none">
                                @foreach($justificaciones as $justificacion)
                                    <div class="card mb-3 border-left-{{ $justificacion->estado->nombre_estado == 'Aprobado' ? 'success' : ($justificacion->estado->nombre_estado == 'Rechazado' ? 'danger' : 'warning') }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1">{{ $justificacion->fecha->format('d/m/Y') }}</h5>
                                                    <span class="badge bg-{{ $justificacion->estado->nombre_estado == 'Aprobado' ? 'success' : ($justificacion->estado->nombre_estado == 'Rechazado' ? 'danger' : 'warning') }}">
                                                {{ $justificacion->estado->nombre_estado }}
                                            </span>
                                                </div>
                                                <small class="text-muted">{{ $justificacion->created_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                            <p class="mt-2 mb-2">{{ Str::limit($justificacion->motivo, 100) }}</p>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#justificacionModal{{ $justificacion->id }}">
                                                    <i class="fas fa-eye mr-1"></i> Detalles
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal para móviles -->
                                    <div class="modal fade" id="justificacionModal{{ $justificacion->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Detalles de Justificación</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <h6>Fecha Justificada</h6>
                                                        <p>{{ $justificacion->fecha->format('d/m/Y') }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Estado</h6>
                                                        <span class="badge bg-{{ $justificacion->estado->nombre_estado == 'Aprobado' ? 'success' : ($justificacion->estado->nombre_estado == 'Rechazado' ? 'danger' : 'warning') }}">
                                                    {{ $justificacion->estado->nombre_estado }}
                                                </span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Motivo</h6>
                                                        <p>{{ $justificacion->motivo }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Fecha de Registro</h6>
                                                        <p>{{ $justificacion->created_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Versión desktop -->
                            <div class="d-none d-lg-block">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" id="justificacionesTable">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th class="text-nowrap"><i class="fas fa-calendar-day mr-2"></i>Fecha</th>
                                            <th><i class="fas fa-comment-alt mr-2"></i>Motivo</th>
                                            <th class="text-nowrap"><i class="fas fa-info-circle mr-2"></i>Estado</th>
                                            <th class="text-nowrap"><i class="fas fa-clock mr-2"></i>Registro</th>
                                            <th class="text-nowrap"><i class="fas fa-cog mr-2"></i>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($justificaciones as $justificacion)
                                            <tr>
                                                <td class="align-middle">
                                                <span class="badge bg-light text-dark">
                                                    {{ $justificacion->fecha->format('d/m/Y') }}
                                                </span>
                                                </td>
                                                <td class="align-middle">{{ Str::limit($justificacion->motivo, 80) }}</td>
                                                <td class="align-middle">
                                                <span class="badge bg-{{ $justificacion->estado->nombre_estado == 'Aprobado' ? 'success' : ($justificacion->estado->nombre_estado == 'Rechazado' ? 'danger' : 'warning') }} p-2">
                                                    {{ $justificacion->estado->nombre_estado }}
                                                </span>
                                                </td>
                                                <td class="align-middle">
                                                    <small class="text-muted">{{ $justificacion->created_at->format('d/m/Y H:i') }}</small>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#justificacionModal{{ $justificacion->id }}"
                                                            title="Ver detalles">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal para desktop -->
                                            <div class="modal fade" id="justificacionModal{{ $justificacion->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Detalles de Justificación</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <h6 class="text-primary"><i class="fas fa-calendar-day mr-2"></i>Fecha Justificada</h6>
                                                                    <p>{{ $justificacion->fecha->format('d/m/Y') }}</p>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <h6 class="text-primary"><i class="fas fa-info-circle mr-2"></i>Estado</h6>
                                                                    <span class="badge bg-{{ $justificacion->estado->nombre_estado == 'Aprobado' ? 'success' : ($justificacion->estado->nombre_estado == 'Rechazado' ? 'danger' : 'warning') }}">
                                                                    {{ $justificacion->estado->nombre_estado }}
                                                                </span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="text-primary"><i class="fas fa-comment-alt mr-2"></i>Motivo</h6>
                                                                <div class="p-3 bg-light rounded">
                                                                    <p class="mb-0">{{ $justificacion->motivo }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h6 class="text-primary"><i class="fas fa-clock mr-2"></i>Fecha de Registro</h6>
                                                                    <p>{{ $justificacion->created_at->format('d/m/Y H:i') }}</p>
                                                                </div>
                                                                @if($justificacion->updated_at != $justificacion->created_at)
                                                                    <div class="col-md-6">
                                                                        <h6 class="text-primary"><i class="fas fa-sync-alt mr-2"></i>Última Actualización</h6>
                                                                        <p>{{ $justificacion->updated_at->format('d/m/Y H:i') }}</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="button" class="btn btn-outline-primary" onclick="window.print()">
                                                                <i class="fas fa-print mr-1"></i> Imprimir
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                        Mostrando {{ $justificaciones->firstItem() }} - {{ $justificaciones->lastItem() }} de {{ $justificaciones->total() }} justificaciones
                                    </div>
                                    <div>
                                        {{ $justificaciones->onEachSide(1)->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Sistema de justificaciones - {{ now()->format('d/m/Y') }}
                            </small>
                            <small>
                                <i class="fas fa-question-circle mr-1"></i>
                                Para ayuda adicional, contacta a Recursos Humanos
                            </small>
                        </div>
                    </div>
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
        .border-left-success {
            border-left: 4px solid #28a745 !important;
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
        .form-control, .form-select {
            border-radius: 0.375rem;
        }
        .input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Mostrar formulario si hay errores
            @if($errors->any())
            new bootstrap.Collapse(document.getElementById('formJustificacion'));
            @endif

            // Filtrado por estado
            document.getElementById('filterStatus').addEventListener('change', function() {
                const status = this.value;
                const rows = document.querySelectorAll('#justificacionesTable tbody tr');

                rows.forEach(row => {
                    const rowStatus = row.querySelector('td:nth-child(3)').textContent.trim();
                    row.style.display = (status === '' || rowStatus.includes(status)) ? '' : 'none';
                });
            });

            // Búsqueda general
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const searchText = this.value.toLowerCase();
                const rows = document.querySelectorAll('#justificacionesTable tbody tr');

                rows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchText) ? '' : 'none';
                });
            });

            // Resetear filtros
            document.getElementById('resetFilters').addEventListener('click', function() {
                document.getElementById('searchInput').value = '';
                document.getElementById('filterStatus').value = '';
                const rows = document.querySelectorAll('#justificacionesTable tbody tr');
                rows.forEach(row => row.style.display = '');
            });

            // Validación del formulario
            const form = document.getElementById('justificacionForm');
            form.addEventListener('submit', function(e) {
                const motivo = document.getElementById('motivo').value;
                if (motivo.length < 30) {
                    e.preventDefault();
                    alert('El motivo debe tener al menos 30 caracteres');
                    return false;
                }
                document.getElementById('submitBtn').disabled = true;
                document.getElementById('submitBtn').innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Enviando...';
            });
        });
    </script>
@endsection
