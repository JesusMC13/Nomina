@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-user-clock mr-2"></i>Detalle de Retardos
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.aplicardescuento.index') }}" class="text-white-50">Control de Retardos</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Detalle</li>
                    </ol>
                </nav>
            </div>
            <div class="text-center">
                <div class="text-sm font-weight-bold">TOTAL DESCUENTO</div>
                <div class="h4 mb-0 text-light">${{ number_format($total_descuento, 2) }}</div>
            </div>
        </div>

        <!-- Información del empleado -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar-lg mr-4">
                                <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold display-4">
                                    {{ substr($empleado->nombre, 0, 1) }}{{ substr($empleado->apellido_paterno, 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <h4 class="mb-1 font-weight-bold">{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h4>
                                <p class="mb-0 text-muted">{{ $empleado->puesto->nombre_puesto }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-right mt-3 mt-md-0">
                        <a href="{{ route('adminn.aplicardescuento.index') }}" class="btn btn-outline-primary rounded-pill">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar al listado
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de retardos -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-list-ol mr-2"></i>Registro de Retardos
                    </h6>
                    <div>
                        <span class="badge badge-light">
                            {{ count($retardos) }} registros
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="dataTable">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">Fecha</th>
                            <th>Turno</th>
                            <th class="text-center">Hora Esperada</th>
                            <th class="text-center">Hora Llegada</th>
                            <th class="text-center">Minutos</th>
                            <th class="text-center">Descuento</th>
                            <th class="text-center">Detalle</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($retardos as $retardo)
                            <tr>
                                <td class="pl-4 font-weight-bold">{{ \Carbon\Carbon::parse($retardo['fecha'])->format('d M, Y') }}</td>
                                <td>{{ $retardo['turno'] }}</td>
                                <td class="text-center">{{ $retardo['hora_esperada'] }}</td>
                                <td class="text-center text-danger font-weight-bold">{{ $retardo['hora_llegada'] }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-warning">
                                        {{ $retardo['minutos_retraso'] }} min
                                    </span>
                                </td>
                                <td class="text-center font-weight-bold text-primary">
                                    ${{ number_format($retardo['descuento'], 2) }}
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill" data-toggle="tooltip"
                                            title="{{ $retardo['detalle_calculo'] }}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
        .avatar-lg {
            width: 60px;
            height: 60px;
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
        }
        .badge-warning {
            background-color: #f6c23e;
            color: #212529;
        }
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
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
                    "order": [[0, "desc"]], // Ordenar por fecha descendente
                    "dom": '<"top"f>rt<"bottom"lip><"clear">',
                    "pageLength": 15
                });

                // Tooltips
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endsection
@endsection
