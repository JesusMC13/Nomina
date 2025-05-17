@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-user-clock mr-2"></i>Administración de Horarios
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Horarios por Turno</li>
                    </ol>
                </nav>
            </div>
            <div>
                <span class="badge badge-light badge-pill shadow-sm text-primary">
                    <i class="fas fa-users mr-1"></i> {{ $horarios->total() }} Registros
                </span>
            </div>
        </div>

        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-calendar-alt mr-2"></i>Control de Horarios
                </h6>
                <div>
                    <a href="{{ route('admin.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Dashboard
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Filtros Avanzados -->
                <form action="{{ route('adminn.horarios.buscar') }}" method="GET" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                </div>
                                <input type="text" name="nombre" class="form-control border-left-0"
                                       placeholder="Buscar empleado..." value="{{ request('nombre') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="puesto" class="form-control select2">
                                <option value="">Todos los puestos</option>
                                @foreach($puestosUnicos as $id => $puesto)
                                    <option value="{{ $id }}" {{ request('puesto') == $id ? 'selected' : '' }}>
                                        {{ $puesto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="turno" class="form-control select2">
                                <option value="">Todos los turnos</option>
                                @foreach($turnosUnicos as $id => $turno)
                                    <option value="{{ $id }}" {{ request('turno') == $id ? 'selected' : '' }}>
                                        {{ $turno }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                                <i class="fas fa-filter mr-1"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Tabla de Resultados -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0" width="100%" cellspacing="0">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">EMPLEADO</th>
                            <th>PUESTO</th>
                            <th>TURNO</th>
                            <th class="text-center">HORARIO</th>
                            <th class="text-center">TOLERANCIA</th>
                            <th class="text-center">DÍAS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($horarios as $empleado)
                            <tr>
                                <td class="pl-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm mr-3">
                                            <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                                {{ substr($empleado->nombre_completo, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">{{ $empleado->nombre_completo }}</h6>
                                            @if($empleado->user)
                                                <small class="text-muted">{{ $empleado->user->email }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-info">
                                        {{ $empleado->puesto->nombre_puesto ?? 'No asignado' }}
                                    </span>
                                </td>
                                <td>
                                    @if($empleado->turno)
                                        <span class="badge badge-pill badge-soft-success">
                                            {{ $empleado->turno->nombre_turno }}
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-soft-danger">
                                            No asignado
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php
                                        $horaEntrada = $empleado->hora_entrada ?: ($empleado->turno->hora_entrada ?? null);
                                        $horaSalida = $empleado->turno->hora_salida ?? null;
                                    @endphp
                                    @if($horaEntrada && $horaSalida)
                                        <span class="text-monospace">
                                            {{ date('h:i A', strtotime($horaEntrada)) }} -
                                            {{ date('h:i A', strtotime($horaSalida)) }}
                                        </span>
                                    @else
                                        <span class="text-muted">--:--</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-soft-warning">
                                        {{ $empleado->turno->tolerancia_minutos ?? 0 }} mins
                                    </span>
                                </td>
                                <td class="text-center">
                                    <small>{{ $empleado->turno->dias_laborales ?? 'No definido' }}</small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-user-slash fa-3x mb-3 text-muted"></i>
                                        <h5 class="font-weight-bold">No se encontraron empleados</h5>
                                        @if(request()->hasAny(['nombre', 'puesto', 'turno']))
                                            <a href="{{ route('adminn.horarios.index') }}" class="btn btn-sm btn-outline-primary mt-3 rounded-pill">
                                                <i class="fas fa-times mr-1"></i> Limpiar filtros
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($horarios->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Mostrando {{ $horarios->firstItem() }} a {{ $horarios->lastItem() }} de {{ $horarios->total() }} registros
                        </div>
                        <div>
                            {{ $horarios->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .bg-light-primary {
            background-color: rgba(78, 115, 223, 0.1);
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        }
        .avatar-sm {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            font-size: 0.875rem;
        }
        .badge-soft-success {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }
        .badge-soft-danger {
            color: #e74a3b;
            background-color: rgba(231, 74, 59, 0.1);
        }
        .badge-soft-info {
            color: #17a2b8;
            background-color: rgba(23, 162, 184, 0.1);
        }
        .badge-soft-warning {
            color: #ffc107;
            background-color: rgba(255, 193, 7, 0.1);
        }
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .text-monospace {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-weight: bold;
        }
        .empty-state {
            opacity: 0.6;
            padding: 2rem 0;
        }
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px);
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en los filtros
            $('.select2').select2({
                placeholder: "Seleccione una opción",
                allowClear: true
            });

            // Tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
