@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Historial de Retardos y Descuentos</h2>
            <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Filtros -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">Filtrar por Fecha</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('adminn.aplicardescuento.index') }}">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio"
                                   class="form-control" value="{{ $fechaInicio }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="fecha_fin">Fecha Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin"
                                   class="form-control" value="{{ $fechaFin }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                            <a href="{{ route('adminn.aplicardescuento.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync-alt"></i> Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Resumen General -->
        <div class="card shadow mb-4">
            <div class="card-header bg-info text-white py-3">
                <h5 class="mb-0">Resumen General</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Empleados</h5>
                                <p class="card-text display-4">{{ $totalEmpleados }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Retardos</h5>
                                <p class="card-text display-4">{{ $totalRetardos }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Descuentos</h5>
                                <p class="card-text display-4">${{ number_format($totalDescuentos, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de Empleados (Versión unificada) -->
        <div class="card shadow">
            <div class="card-header bg-secondary text-white py-3">
                <h5 class="mb-0">Detalle de Retardos por Empleado</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th class="align-middle">Empleado</th>
                            <th class="align-middle">Puesto</th>
                            <th class="align-middle">Turno</th>
                            <th class="align-middle text-center">Retardos</th>
                            <th class="align-middle text-center">Descuentos</th>
                            <th class="align-middle text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($empleados->where('total_retardos', '>', 0) as $empleado)
                            <tr>
                                <td class="align-middle">
                                    <strong>{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</strong>
                                </td>
                                <td class="align-middle">
                                        <span class="badge badge-pill
                                            @switch($empleado->puesto->nombre_puesto)
                                                @case('Gerente') badge-primary @break
                                                @case('Supervisor') badge-info @break
                                                @case('Cocinero') badge-warning @break
                                                @case('Mesero') badge-success @break
                                                @default badge-secondary
                                            @endswitch">
                                            {{ $empleado->puesto->nombre_puesto }}
                                        </span>
                                </td>
                                <td class="align-middle">
                                    {{ $empleado->turno->nombre_turno ?? 'N/A' }}
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-light">{{ $empleado->total_retardos }}</span>
                                </td>
                                <td class="align-middle text-center font-weight-bold
                                        {{ $empleado->total_descuento > 0 ? 'text-danger' : 'text-success' }}">
                                    ${{ number_format($empleado->total_descuento, 2) }}
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('adminn.aplicardescuento.detalle', [
                                            'id' => $empleado->ID_empleado,
                                            'fecha_inicio' => $fechaInicio,
                                            'fecha_fin' => $fechaFin
                                        ]) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Ver detalles de retardos">
                                        <i class="fas fa-search"></i> Detalles
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-info-circle fa-2x mb-3 text-muted"></i>
                                    <p class="h5 text-muted">No hay retardos registrados en el período seleccionado</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .table {
            font-size: 0.9rem;
        }
        .table th {
            border-top: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }
        .table td {
            vertical-align: middle;
        }
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
        .badge-primary {
            background-color: #4e73df;
        }
        .badge-info {
            background-color: #36b9cc;
        }
        .badge-warning {
            background-color: #f6c23e;
            color: #1a1a1a;
        }
        .badge-success {
            background-color: #1cc88a;
        }
        .badge-secondary {
            background-color: #858796;
        }
        .badge-light {
            background-color: #f8f9fc;
            color: #4e73df;
            border: 1px solid #d1d3e2;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.01);
        }
        .card-title {
            font-size: 0.9rem;
            font-weight: 600;
        }
        .display-4 {
            font-size: 2rem;
        }
    </style>
@endsection
