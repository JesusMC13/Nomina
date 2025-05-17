@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section - Azul -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-clock mr-2"></i>Retardos Registrados
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Retardos</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow-sm text-primary">
                <i class="fas fa-user-clock mr-1"></i>
                @if(method_exists($asistencias, 'total'))
                    {{ $asistencias->total() }} Registros
                @else
                    {{ $asistencias->count() }} Registros
                @endif
            </span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end mb-4">
            <form action="{{ route('adminn.retardos.actualizar') }}" method="POST" class="mr-2">
                @csrf
                <button type="submit" class="btn btn-primary rounded-pill shadow-sm">
                    <i class="fas fa-sync-alt mr-2"></i> Actualizar Retardos
                </button>
            </form>
            <a href="{{ route('admin.index') }}" class="btn btn-outline-primary rounded-pill shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i> Regresar
            </a>
        </div>

        <!-- Alert Messages -->
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

        <!-- Filters -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body py-3">
                <div class="row">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <label class="small text-muted mb-1">Filtrar por fecha</label>
                        <input type="date" id="dateFilter" class="form-control form-control-sm rounded-pill shadow-sm">
                    </div>
                    <div class="col-md-6">
                        <label class="small text-muted mb-1">Ordenar por</label>
                        <select id="sortFilter" class="form-control form-control-sm rounded-pill shadow-sm">
                            <option value="2-desc">Fecha (reciente)</option>
                            <option value="2-asc">Fecha (antigua)</option>
                            <option value="5-desc">Retardo (mayor)</option>
                            <option value="5-asc">Retardo (menor)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-list-ul mr-2"></i>Historial de Retardos
                </h6>
            </div>
            <div class="card-body p-0">
                @if($asistencias->isEmpty())
                    <div class="text-center py-5">
                        <i class="far fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay retardos registrados</h4>
                        <p class="text-muted">No se han encontrado registros de retardos.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-light-primary">
                            <tr>
                                <th class="pl-4">Empleado</th>
                                <th>Puesto</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Hora Esperada</th>
                                <th class="text-center">Hora Real</th>
                                <th class="text-center">Retraso</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asistencias as $asistencia)
                                @php
                                    $retrasoHoras = floor($asistencia->minutos_retraso / 60);
                                    $retrasoMinutos = $asistencia->minutos_retraso % 60;
                                @endphp
                                <tr>
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
                                    <td>{{ $asistencia->empleado->puesto->nombre_puesto ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-light shadow-sm">
                                            {{ $asistencia->fecha->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-success font-weight-bold">
                                            {{ $asistencia->empleado->turno->hora_entrada ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-danger font-weight-bold">
                                            {{ $asistencia->hora_entrada_formateada }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-danger">
                                            @if($retrasoHoras > 0)
                                                {{ $retrasoHoras }}h {{ $retrasoMinutos }}m
                                            @else
                                                {{ $retrasoMinutos }}m
                                            @endif
                                        </span>
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

    <!-- Styles -->
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
        .badge-danger {
            background-color: #e74a3b;
        }
        .btn-outline-primary {
            color: #4e73df;
            border-color: #4e73df;
        }
        .btn-outline-primary:hover {
            background-color: #4e73df;
            color: white;
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Initialize DataTable
                const dataTable = $('#dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "responsive": true,
                    "dom": '<"top"f>rt<"bottom"lip><"clear">',
                    "pageLength": 15,
                    "columnDefs": [
                        {
                            "type": "date",
                            "targets": 2,
                            "render": function(data) {
                                const parts = data.split('/');
                                return new Date(parts[2], parts[1] - 1, parts[0]);
                            }
                        },
                        {
                            "type": "num",
                            "targets": 5
                        }
                    ],
                    "order": [[2, "desc"]]
                });

                // Date filter
                $('#dateFilter').on('change', function() {
                    const date = $(this).val();
                    if(date) {
                        const formattedDate = date.split('-').reverse().join('/');
                        dataTable.column(2).search(formattedDate).draw();
                    } else {
                        dataTable.column(2).search('').draw();
                    }
                });

                // Sort filter
                $('#sortFilter').on('change', function() {
                    const [column, order] = this.value.split('-');
                    dataTable.order([parseInt(column), order]).draw();
                });
            });
        </script>
    @endsection
@endsection
