@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-clock mr-2"></i>Control de Retardos y Descuentos
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Descuentos por Retardos</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex align-items-center">
                <div class="mr-3 text-center">
                    <div class="text-sm font-weight-bold">EMPLEADOS</div>
                    <div class="h5 mb-0">{{ $totalEmpleados }}</div>
                </div>
                <div class="mr-3 text-center">
                    <div class="text-sm font-weight-bold">RETARDOS</div>
                    <div class="h5 mb-0 text-warning">{{ $totalRetardos }}</div>
                </div>
                <div class="text-center">
                    <div class="text-sm font-weight-bold">TOTAL DESCUENTO</div>
                    <div class="h5 mb-0 text-light">${{ number_format($totalDescuentos, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Filtros Simplificados -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body py-3">
                <form method="GET" class="row align-items-end">
                    <div class="col-md-5 mb-2 mb-md-0">
                        <label class="small font-weight-bold text-muted">Rango de Fechas</label>
                        <div class="input-group">
                            <input type="date" name="fecha_inicio" class="form-control form-control-sm border-right-0 rounded-left-pill"
                                   value="{{ $fechaInicio }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text bg-white">a</span>
                            </div>
                            <input type="date" name="fecha_fin" class="form-control form-control-sm rounded-right-pill"
                                   value="{{ $fechaFin }}" required>
                        </div>
                    </div>
                    <div class="col-md-5 mb-2 mb-md-0">
                        <label class="small font-weight-bold text-muted">Tipo de Descuento</label>
                        <select name="tipo_descuento" class="form-control form-control-sm rounded-pill">
                            <option value="">Todos</option>
                            <option value="retencion" {{ request('tipo_descuento') == 'retencion' ? 'selected' : '' }}>Retención</option>
                            <option value="descuento" {{ request('tipo_descuento') == 'descuento' ? 'selected' : '' }}>Descuento Directo</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill shadow-sm w-100">
                            <i class="fas fa-filter mr-1"></i> Aplicar Filtros
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tarjeta de Resultados -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-list-ol mr-2"></i>Resultados de Descuentos
                    </h6>
                </div>
            </div>

            <div class="card-body p-0">
                @if($empleados->isEmpty())
                    <div class="text-center py-5">
                        <i class="far fa-calendar-check fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay retardos registrados</h4>
                        <p class="text-muted">No se encontraron retardos con los filtros aplicados</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTable">
                            <thead class="bg-light-primary">
                            <tr>
                                <th class="pl-4">Empleado</th>
                                <th class="text-center">Retardos</th>
                                <th class="text-center">Minutos</th>
                                <th class="text-center">Descuento</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($empleados as $emp)
                                <tr>
                                    <td class="pl-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-3">
                                                <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                                    {{ substr($emp->nombre, 0, 1) }}{{ substr($emp->apellido_paterno, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 font-weight-bold">{{ $emp->nombre }}</h6>
                                                <small class="text-muted">{{ $emp->puesto->nombre_puesto }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-warning">
                                            {{ $emp->total_retardos }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-secondary">
                                            {{ $emp->total_minutos }} min
                                        </span>
                                    </td>
                                    <td class="text-center font-weight-bold text-primary">
                                        ${{ number_format($emp->total_descuento, 2) }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill {{ $emp->tipo_descuento == 'retencion' ? 'badge-info' : 'badge-primary' }}">
                                            {{ $emp->tipo_descuento == 'retencion' ? 'Retención' : 'Descuento' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('adminn.aplicardescuento.detalle', $emp->ID_empleado) }}?fecha_inicio={{ $fechaInicio }}&fecha_fin={{ $fechaFin }}"
                                               class="btn btn-sm btn-outline-primary rounded-circle mr-2"
                                               data-toggle="tooltip" title="Ver detalle">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-primary rounded-circle"
                                                    data-toggle="modal" data-target="#aplicarModal{{ $emp->ID_empleado }}"
                                                    title="Aplicar descuento">
                                                <i class="fas fa-hand-holding-usd"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal para Aplicar Descuento -->
                                <div class="modal fade" id="aplicarModal{{ $emp->ID_empleado }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Detalle de Descuento</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Empleado</label>
                                                    <p>{{ $emp->nombre_completo }}</p>
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold">Total a Descontar</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">$</span>
                                                        </div>
                                                        <input type="text" class="form-control" value="{{ number_format($emp->total_descuento, 2) }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Pie de tabla modificado -->
            <div class="card-footer bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            @if(method_exists($empleados, 'firstItem'))
                                Mostrando <strong>{{ $empleados->firstItem() }}</strong> a <strong>{{ $empleados->lastItem() }}</strong> de <strong>{{ $empleados->total() }}</strong> registros
                            @else
                                Mostrando <strong>{{ count($empleados) }}</strong> registros
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            @if(method_exists($empleados, 'links'))
                                {{ $empleados->appends(request()->query())->links() }}
                            @endif
                        </div>
                    </div>
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
        .rounded-left-pill {
            border-top-left-radius: 50rem !important;
            border-bottom-left-radius: 50rem !important;
        }
        .rounded-right-pill {
            border-top-right-radius: 50rem !important;
            border-bottom-right-radius: 50rem !important;
        }
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .badge-warning {
            background-color: #f6c23e;
            color: #212529;
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
                        { "orderable": false, "targets": [5] }
                    ],
                    "order": [[3, "desc"]] // Ordenar por descuento (columna 3)
                });

                // Tooltips
                $('[data-toggle="tooltip"]').tooltip();

                // Formato de moneda para inputs
                $('input[type="text"][readonly]').each(function() {
                    $(this).val(parseFloat($(this).val()).toLocaleString('es-MX', {
                        style: 'currency',
                        currency: 'MXN',
                        minimumFractionDigits: 2
                    }));
                });
            });
        </script>
    @endsection
@endsection
