@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-user-clock mr-2"></i>Asignación de Turnos
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Asignación Turnos</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow-sm text-primary">
                <i class="fas fa-users mr-1"></i> {{ count($empleados) }} Empleados
            </span>
            </div>
        </div>

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

        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-list-ul mr-2"></i>Lista de Empleados
                </h6>
                <div>
                    <a href="{{ route('admin.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Dashboard
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">EMPLEADO</th>
                            <th>TURNO ACTUAL</th>
                            <th class="text-center">HORARIO</th>
                            <th class="text-center" style="width: 180px;">ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td class="pl-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm mr-3">
                                            <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                                {{ substr($empleado->nombre, 0, 1) }}{{ substr($empleado->apellido_paterno, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">{{ $empleado->nombre }}</h6>
                                            <small class="text-muted">{{ $empleado->apellido_paterno }} {{ $empleado->apellido_materno }}</small>
                                        </div>
                                    </div>
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
                                    @if($empleado->turno)
                                        <span class="text-muted">
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $empleado->turno->hora_entrada)->format('h:i A') }} -
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $empleado->turno->hora_salida)->format('h:i A') }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('adminn.asignar.turnos.show', $empleado->ID_empleado) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                       data-toggle="tooltip" title="Asignar/Modificar Turno">
                                        <i class="fas fa-user-clock mr-1"></i> Gestionar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos CSS -->
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
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .text-primary {
            color: #4e73df !important;
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "responsive": true,
                    "dom": '<"top"f>rt<"bottom"lip><"clear">',
                    "pageLength": 10,
                    "columnDefs": [
                        { "orderable": false, "targets": [3] }
                    ]
                });

                $('[data-toggle="tooltip"]').tooltip();

                $('.dataTables_filter input').addClass('form-control form-control-sm');
            });
        </script>
    @endsection
@endsection
