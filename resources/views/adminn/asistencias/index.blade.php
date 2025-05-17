@extends('layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-clipboard-check mr-2"></i>Registro de Asistencias
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Asistencias</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow-sm text-primary">
                <i class="fas fa-history mr-1"></i>
                @if(method_exists($asistencias, 'total'))
                    {{ $asistencias->total() }} Registros
                @else
                    {{ $asistencias->count() }} Registros
                @endif
            </span>
            </div>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bg-success rounded-circle p-2 mr-3">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">¡Operación Exitosa!</h6>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bg-danger rounded-circle p-2 mr-3">
                        <i class="fas fa-exclamation text-white"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">¡Error!</h6>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                    <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <!-- Filtros -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body py-3">
                <div class="row">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="small text-muted mb-1">Filtrar por fecha</label>
                        <input type="date" id="dateFilter" class="form-control form-control-sm rounded-pill shadow-sm">
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="small text-muted mb-1">Filtrar por empleado</label>
                        <select id="employeeFilter" class="form-control form-control-sm rounded-pill shadow-sm">
                            <option value="">Todos los empleados</option>
                            @foreach($empleados->sortBy('apellido_paterno') as $empleado)
                                <option value="{{ $empleado->id }}">
                                    {{ $empleado->apellido_paterno }}, {{ $empleado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted mb-1">Ordenar por</label>
                        <select id="sortFilter" class="form-control form-control-sm rounded-pill shadow-sm">
                            <option value="1-desc">Fecha (más reciente primero)</option>
                            <option value="1-asc">Fecha (más antigua primero)</option>
                            <option value="0-asc">Empleado (A-Z)</option>
                            <option value="0-desc">Empleado (Z-A)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de asistencias -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-list-ul mr-2"></i>Historial de Asistencias
                </h6>
            </div>
            <div class="card-body p-0">
                @if($asistencias->isEmpty())
                    <div class="text-center py-5">
                        <i class="far fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay asistencias registradas</h4>
                        <p class="text-muted">No se han encontrado registros de asistencia.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-light-primary">
                            <tr>
                                <th class="pl-4">EMPLEADO</th>
                                <th class="text-center">FECHA</th>
                                <th class="text-center">ENTRADA</th>
                                <th class="text-center">SALIDA</th>
                                <th class="text-center">HORAS</th>
                                <th class="text-center">ESTADO</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asistencias as $asistencia)
                                @php
                                    $entrada = \Carbon\Carbon::parse($asistencia->hora_inicio);
                                    $salida = \Carbon\Carbon::parse($asistencia->hora_fin);
                                    $horasTrabajadas = $entrada->diff($salida)->format('%H:%I');
                                    $isLate = $entrada->gt(\Carbon\Carbon::createFromTime(8, 15));
                                    $empleadoNombre = $asistencia->empleado->apellido_paterno.' '.$asistencia->empleado->nombre;
                                @endphp
                                <tr class="{{ $isLate ? 'table-warning' : '' }}" data-employee-id="{{ $asistencia->empleado->id }}"
                                    data-date="{{ \Carbon\Carbon::parse($asistencia->fecha)->format('Y-m-d') }}"
                                    data-employee-name="{{ $empleadoNombre }}">
                                    <td class="pl-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-3">
                                                <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                                    {{ substr($asistencia->empleado->nombre, 0, 1) }}{{ substr($asistencia->empleado->apellido_paterno, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 font-weight-bold">{{ $asistencia->empleado->nombre }}</h6>
                                                <small class="text-muted">{{ $asistencia->empleado->apellido_paterno }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-light shadow-sm">
                                            {{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-success font-weight-bold">
                                            {{ $entrada->format('h:i A') }}
                                            @if($isLate)
                                                <i class="fas fa-clock text-warning ml-1" title="Llegó tarde"></i>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-danger font-weight-bold">
                                            {{ $salida->format('h:i A') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-soft-info">
                                            {{ $horasTrabajadas }} hrs
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($isLate)
                                            <span class="badge badge-pill badge-warning">Tardanza</span>
                                        @else
                                            <span class="badge badge-pill badge-success">Puntual</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            @if(method_exists($asistencias, 'hasPages') && $asistencias->hasPages())
                <div class="card-footer bg-white border-0 d-flex justify-content-center">
                    {{ $asistencias->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .bg-light-primary {
            background-color: rgba(78, 115, 223, 0.1);
        }
        .bg-soft-primary {
            background-color: rgba(78, 115, 223, 0.2);
        }
        .bg-soft-info {
            background-color: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
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
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .text-primary {
            color: #4e73df !important;
        }
        .table-warning {
            background-color: rgba(255, 193, 7, 0.1);
        }
        .badge-soft-success {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }
    </style>

    @section('scripts')
        <script>
            $(document).ready(function() {
                // Initialize DataTable with custom sorting
                const dataTable = $('#dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "responsive": true,
                    "dom": '<"top"f>rt<"bottom"lip><"clear">',
                    "pageLength": 10,
                    "columnDefs": [
                        {
                            "orderable": false,
                            "targets": [5]
                        },
                        {
                            "type": "date",
                            "targets": 1,
                            "render": function(data) {
                                // Convert dd/mm/yyyy to yyyy-mm-dd for sorting
                                const parts = data.split('/');
                                return new Date(parts[2], parts[1] - 1, parts[0]);
                            }
                        }
                    ],
                    "order": [[1, "desc"]], // Default order by date descending
                    "createdRow": function(row, data, dataIndex) {
                        // Add data attributes for filtering
                        const employeeId = $(row).attr('data-employee-id');
                        const date = $(row).attr('data-date');
                        const employeeName = $(row).attr('data-employee-name');
                        $(row).find('td').eq(0).attr('data-search', employeeName);
                        $(row).find('td').eq(1).attr('data-search', date);
                    }
                });

                // Date filter handler
                $('#dateFilter').on('change', function() {
                    const date = $(this).val();
                    dataTable.column(1).search(date).draw();
                });

                // Employee filter handler
                $('#employeeFilter').on('change', function() {
                    const employeeId = $(this).val();
                    dataTable.column(0).search(employeeId).draw();
                });

                // Sort filter handler
                $('#sortFilter').on('change', function() {
                    const value = $(this).val().split('-');
                    const column = parseInt(value[0]);
                    const direction = value[1];
                    dataTable.order([column, direction]).draw();
                });

                // Tooltips
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endsection
@endsection@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-clipboard-check mr-2"></i>Registro de Asistencias
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Asistencias</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow-sm text-primary">
                <i class="fas fa-history mr-1"></i>
                @if(method_exists($asistencias, 'total'))
                    {{ $asistencias->total() }} Registros
                @else
                    {{ $asistencias->count() }} Registros
                @endif
            </span>
            </div>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bg-success rounded-circle p-2 mr-3">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">¡Operación Exitosa!</h6>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bg-danger rounded-circle p-2 mr-3">
                        <i class="fas fa-exclamation text-white"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">¡Error!</h6>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                    <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <!-- Filtros -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body py-3">
                <div class="row">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="small text-muted mb-1">Filtrar por fecha</label>
                        <input type="date" id="dateFilter" class="form-control form-control-sm rounded-pill shadow-sm">
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="small text-muted mb-1">Filtrar por empleado</label>
                        <select id="employeeFilter" class="form-control form-control-sm rounded-pill shadow-sm">
                            <option value="">Todos los empleados</option>
                            @foreach($empleados->sortBy('apellido_paterno') as $empleado)
                                <option value="{{ $empleado->id }}">
                                    {{ $empleado->apellido_paterno }}, {{ $empleado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted mb-1">Ordenar por</label>
                        <select id="sortFilter" class="form-control form-control-sm rounded-pill shadow-sm">
                            <option value="1-desc">Fecha (más reciente primero)</option>
                            <option value="1-asc">Fecha (más antigua primero)</option>
                            <option value="0-asc">Empleado (A-Z)</option>
                            <option value="0-desc">Empleado (Z-A)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de asistencias -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-list-ul mr-2"></i>Historial de Asistencias
                </h6>
            </div>
            <div class="card-body p-0">
                @if($asistencias->isEmpty())
                    <div class="text-center py-5">
                        <i class="far fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay asistencias registradas</h4>
                        <p class="text-muted">No se han encontrado registros de asistencia.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-light-primary">
                            <tr>
                                <th class="pl-4">EMPLEADO</th>
                                <th class="text-center">FECHA</th>
                                <th class="text-center">ENTRADA</th>
                                <th class="text-center">SALIDA</th>
                                <th class="text-center">HORAS</th>
                                <th class="text-center">ESTADO</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asistencias as $asistencia)
                                @php
                                    $entrada = \Carbon\Carbon::parse($asistencia->hora_inicio);
                                    $salida = \Carbon\Carbon::parse($asistencia->hora_fin);
                                    $horasTrabajadas = $entrada->diff($salida)->format('%H:%I');
                                    $isLate = $entrada->gt(\Carbon\Carbon::createFromTime(8, 15));
                                    $empleadoNombre = $asistencia->empleado->apellido_paterno.' '.$asistencia->empleado->nombre;
                                @endphp
                                <tr class="{{ $isLate ? 'table-warning' : '' }}" data-employee-id="{{ $asistencia->empleado->id }}"
                                    data-date="{{ \Carbon\Carbon::parse($asistencia->fecha)->format('Y-m-d') }}"
                                    data-employee-name="{{ $empleadoNombre }}">
                                    <td class="pl-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-3">
                                                <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                                    {{ substr($asistencia->empleado->nombre, 0, 1) }}{{ substr($asistencia->empleado->apellido_paterno, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 font-weight-bold">{{ $asistencia->empleado->nombre }}</h6>
                                                <small class="text-muted">{{ $asistencia->empleado->apellido_paterno }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-light shadow-sm">
                                            {{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-success font-weight-bold">
                                            {{ $entrada->format('h:i A') }}
                                            @if($isLate)
                                                <i class="fas fa-clock text-warning ml-1" title="Llegó tarde"></i>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-danger font-weight-bold">
                                            {{ $salida->format('h:i A') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-soft-info">
                                            {{ $horasTrabajadas }} hrs
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($isLate)
                                            <span class="badge badge-pill badge-warning">Tardanza</span>
                                        @else
                                            <span class="badge badge-pill badge-success">Puntual</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            @if(method_exists($asistencias, 'hasPages') && $asistencias->hasPages())
                <div class="card-footer bg-white border-0 d-flex justify-content-center">
                    {{ $asistencias->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .bg-light-primary {
            background-color: rgba(78, 115, 223, 0.1);
        }
        .bg-soft-primary {
            background-color: rgba(78, 115, 223, 0.2);
        }
        .bg-soft-info {
            background-color: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
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
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .text-primary {
            color: #4e73df !important;
        }
        .table-warning {
            background-color: rgba(255, 193, 7, 0.1);
        }
        .badge-soft-success {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }
    </style>

    @section('scripts')
        <script>
            $(document).ready(function() {
                // Initialize DataTable with custom sorting
                const dataTable = $('#dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "responsive": true,
                    "dom": '<"top"f>rt<"bottom"lip><"clear">',
                    "pageLength": 10,
                    "columnDefs": [
                        {
                            "orderable": false,
                            "targets": [5]
                        },
                        {
                            "type": "date",
                            "targets": 1,
                            "render": function(data) {
                                // Convert dd/mm/yyyy to yyyy-mm-dd for sorting
                                const parts = data.split('/');
                                return new Date(parts[2], parts[1] - 1, parts[0]);
                            }
                        }
                    ],
                    "order": [[1, "desc"]], // Default order by date descending
                    "createdRow": function(row, data, dataIndex) {
                        // Add data attributes for filtering
                        const employeeId = $(row).attr('data-employee-id');
                        const date = $(row).attr('data-date');
                        const employeeName = $(row).attr('data-employee-name');
                        $(row).find('td').eq(0).attr('data-search', employeeName);
                        $(row).find('td').eq(1).attr('data-search', date);
                    }
                });

                // Date filter handler
                $('#dateFilter').on('change', function() {
                    const date = $(this).val();
                    dataTable.column(1).search(date).draw();
                });

                // Employee filter handler
                $('#employeeFilter').on('change', function() {
                    const employeeId = $(this).val();
                    dataTable.column(0).search(employeeId).draw();
                });

                // Sort filter handler
                $('#sortFilter').on('change', function() {
                    const value = $(this).val().split('-');
                    const column = parseInt(value[0]);
                    const direction = value[1];
                    dataTable.order([column, direction]).draw();
                });

                // Tooltips
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endsection
@endsection
