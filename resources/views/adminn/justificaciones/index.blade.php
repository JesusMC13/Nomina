@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-clipboard-list mr-2"></i>Solicitudes de Justificación
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Justificaciones</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow-sm text-primary">
                <i class="fas fa-file-alt mr-1"></i> {{ $justificaciones->total() }} Registros
            </span>
            </div>
        </div>

        <!-- Alertas Mejoradas -->
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
                        <h6 class="mb-0 font-weight-bold">¡Error en la Operación!</h6>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                    <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <!-- Card Principal -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <!-- Card Header con Filtros -->
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-filter mr-2"></i>Filtrar Solicitudes
                </h6>
                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle rounded-pill shadow-sm" type="button"
                            id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-sliders-h mr-1"></i> Opciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="filterDropdown">
                        <h6 class="dropdown-header">Estados de Justificación</h6>
                        <a class="dropdown-item" href="?estado=todos">
                            <span class="badge badge-pill badge-secondary mr-2">Todos</span>
                        </a>
                        @foreach($estados as $estado)
                            <a class="dropdown-item d-flex align-items-center" href="?estado={{ $estado->ID_estado }}">
                            <span class="badge badge-pill
                                @if($estado->ID_estado == 2) badge-success
                                @elseif($estado->ID_estado == 3) badge-danger
                                @else badge-warning @endif mr-2">
                            </span>
                                {{ $estado->nombre_estado }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">Empleado</th>
                            <th>Fecha</th>
                            <th>Motivo</th>
                            <th class="text-center">Estado</th>
                            <th>Registro</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($justificaciones as $justificacion)
                            <tr>
                                <td class="pl-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm mr-3">
                                            <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                                {{ substr($justificacion->empleado->nombre, 0, 1) }}{{ substr($justificacion->empleado->apellido_paterno, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">{{ $justificacion->empleado->nombre }}</h6>
                                            <small class="text-muted">{{ $justificacion->empleado->apellido_paterno }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-light shadow-sm">
                                        {{ $justificacion->fecha->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span data-toggle="tooltip" title="{{ $justificacion->motivo }}">
                                        {{ Str::limit($justificacion->motivo, 50) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill
                                        @if($justificacion->estado->ID_estado == 2) badge-success
                                        @elseif($justificacion->estado->ID_estado == 3) badge-danger
                                        @else badge-warning @endif">
                                        {{ $justificacion->estado->nombre_estado }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $justificacion->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('adminn.justificaciones.show', $justificacion->ID_justificacion) }}"
                                           class="btn btn-sm btn-outline-primary rounded-circle mr-2"
                                           data-toggle="tooltip" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($justificacion->estado->ID_estado == 1)
                                            <form method="POST" action="{{ route('adminn.justificaciones.estado', $justificacion->ID_justificacion) }}" class="mr-2">
                                                @csrf
                                                <input type="hidden" name="estado" value="2">
                                                <button type="submit" class="btn btn-sm btn-outline-success rounded-circle"
                                                        data-toggle="tooltip" title="Aprobar">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('adminn.justificaciones.estado', $justificacion->ID_justificacion) }}">
                                                @csrf
                                                <input type="hidden" name="estado" value="3">
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"
                                                        data-toggle="tooltip" title="Rechazar">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="far fa-folder-open fa-3x text-muted mb-3"></i>
                                    <h4 class="text-muted">No hay justificaciones</h4>
                                    <p class="text-muted">No se encontraron solicitudes de justificación</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Card Footer - Paginación -->
            @if($justificaciones->hasPages())
                <div class="card-footer bg-white border-0 d-flex justify-content-center">
                    {{ $justificaciones->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Estilos CSS Personalizados -->
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
        .btn-rounded-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        .dropdown-menu {
            min-width: 200px;
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Inicializar DataTable
                $('#dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "responsive": true,
                    "dom": '<"top"f>rt<"bottom"lip><"clear">',
                    "pageLength": 15,
                    "columnDefs": [
                        { "orderable": false, "targets": [5] },
                        {
                            "type": "date",
                            "targets": 1,
                            "render": function(data) {
                                const parts = data.split('/');
                                return new Date(parts[2], parts[1] - 1, parts[0]);
                            }
                        }
                    ],
                    "order": [[4, "desc"]]
                });

                // Tooltips
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endsection
@endsection
