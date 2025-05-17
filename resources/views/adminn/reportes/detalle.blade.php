@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-file-invoice-dollar mr-2"></i>Detalle del Reporte de Nómina
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.reportes.ver') }}" class="text-white-50">Reportes</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Detalle</li>
                    </ol>
                </nav>
            </div>
            <div class="badge badge-light">
                Reporte #{{ $reporte->ID_reporte }}
            </div>
        </div>

        <!-- Tarjeta principal -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <h5 class="m-0 font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Información del Reporte
                </h5>
            </div>

            <div class="card-body">
                <!-- Resumen del reporte -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-box bg-light-primary p-3 rounded-lg mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt fa-2x text-primary mr-3"></i>
                                <div>
                                    <h6 class="font-weight-bold text-primary mb-1">Fecha del Reporte</h6>
                                    <p class="mb-0">{{ $reporte->fecha_reporte->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="info-box bg-light-primary p-3 rounded-lg">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-dollar-sign fa-2x text-primary mr-3"></i>
                                <div>
                                    <h6 class="font-weight-bold text-primary mb-1">Total Nómina</h6>
                                    <p class="mb-0">${{ number_format($reporte->total_nomina, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-light-primary p-3 rounded-lg mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-tie fa-2x text-primary mr-3"></i>
                                <div>
                                    <h6 class="font-weight-bold text-primary mb-1">Generado por</h6>
                                    <p class="mb-0">{{ $reporte->creador->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="info-box bg-light-primary p-3 rounded-lg">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users fa-2x text-primary mr-3"></i>
                                <div>
                                    <h6 class="font-weight-bold text-primary mb-1">Empleados incluidos</h6>
                                    <p class="mb-0">{{ $reporte->total_empleados }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detalles por empleado -->
                <h4 class="font-weight-bold text-primary mb-3">
                    <i class="fas fa-user-clock mr-2"></i>Detalles por Empleado
                </h4>
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="detallesTable">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">Empleado</th>
                            <th>Puesto</th>
                            <th class="text-right">Sueldo Diario</th>
                            <th class="text-right">Días Trabajados</th>
                            <th class="text-right">Descuentos</th>
                            <th class="text-right">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($detalles as $detalle)
                            <tr>
                                <td class="pl-4 font-weight-bold">{{ $detalle['nombre'] ?? 'N/A' }}</td>
                                <td>{{ $detalle['puesto'] ?? 'N/A' }}</td>
                                <td class="text-right">${{ number_format($detalle['sueldo_diario'] ?? 0, 2) }}</td>
                                <td class="text-right">{{ $detalle['dias_trabajados'] ?? 0 }}</td>
                                <td class="text-right text-danger">${{ number_format($detalle['descuentos'] ?? 0, 2) }}</td>
                                <td class="text-right text-primary font-weight-bold">${{ number_format($detalle['pago_total'] ?? 0, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-exclamation-circle fa-2x text-muted mb-3"></i>
                                    <h5 class="text-muted">No hay detalles disponibles</h5>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Botón de regreso -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('adminn.reportes.ver') }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="fas fa-arrow-left mr-2"></i> Volver a Reportes
                    </a>
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
        .info-box {
            transition: transform 0.3s ease;
        }
        .info-box:hover {
            transform: translateY(-3px);
        }
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .rounded-pill {
            border-radius: 50rem !important;
        }
        .card {
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Inicializar DataTable
                $('#detallesTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "responsive": true,
                    "dom": '<"top"f>rt<"bottom"lip><"clear">',
                    "pageLength": 10,
                    "columnDefs": [
                        { "orderable": false, "targets": [1] }
                    ],
                    "order": [[0, "asc"]]
                });
            });
        </script>
    @endsection
@endsection
