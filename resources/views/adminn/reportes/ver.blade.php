@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-file-invoice-dollar mr-2"></i>Reportes de Nómina
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Reportes</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mb-4">
            <div>
                <a href="{{ route('adminn.reportes.generar') }}" class="btn btn-primary rounded-pill shadow-sm px-4">
                    <i class="fas fa-plus-circle mr-2"></i>Nuevo Reporte
                </a>
            </div>
            <div>
                <a href="{{ route('admin.index') }}" class="btn btn-outline-primary rounded-pill shadow-sm px-4">
                    <i class="fas fa-arrow-left mr-2"></i>Regresar
                </a>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-lg shadow-sm" role="alert">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-lg shadow-sm" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Reports Table -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-list-ol mr-2"></i>Historial de Reportes
                    </h6>
                    <span class="badge badge-light">
                    {{ $reportes->total() }} registros
                </span>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="dataTable">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">Fecha</th>
                            <th>Empleado</th>
                            <th class="text-right">Total Nómina</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reportes as $reporte)
                            <tr>
                                <td class="pl-4 font-weight-bold">{{ $reporte->fecha_reporte->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $detalles = is_array($reporte->detalles) ? $reporte->detalles : json_decode($reporte->detalles, true);
                                        echo $detalles[0]['nombre'] ?? 'N/A';
                                    @endphp
                                </td>
                                <td class="text-right text-primary font-weight-bold">${{ number_format($reporte->total_nomina, 2) }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <!-- View Button -->
                                        <a href="{{ route('adminn.reportes.show', $reporte->ID_reporte) }}"
                                           class="btn btn-sm btn-outline-primary rounded-circle mr-2"
                                           data-toggle="tooltip" title="Ver detalle">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- PDF Export Button -->
                                        <a href="{{ route('adminn.reportes.exportar-pdf', $reporte->ID_reporte) }}"
                                           class="btn btn-sm btn-outline-danger rounded-circle mr-2"
                                           data-toggle="tooltip" title="Exportar PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('adminn.reportes.destroy', $reporte->ID_reporte) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-warning rounded-circle"
                                                    data-toggle="tooltip" title="Eliminar"
                                                    onclick="return confirm('¿Está seguro de eliminar este reporte?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-file-excel fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No hay reportes generados</h5>
                                    <p class="text-muted">Utilice el botón "Nuevo Reporte" para comenzar</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($reportes->hasPages())
                <div class="card-footer bg-white border-0">
                    <div class="d-flex justify-content-center">
                        {{ $reportes->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .bg-light-primary {
            background-color: rgba(78, 115, 223, 0.1);
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
        .rounded-circle {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Initialize DataTable
                $('#dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    "responsive": true,
                    "dom": '<"top"f>rt<"bottom"lip><"clear">',
                    "pageLength": 15,
                    "columnDefs": [
                        { "orderable": false, "targets": [3] }
                    ],
                    "order": [[0, "desc"]]
                });

                // Tooltips
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endsection
@endsection
