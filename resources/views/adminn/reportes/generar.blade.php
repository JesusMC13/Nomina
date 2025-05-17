@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-file-invoice-dollar mr-2"></i>Generar Reporte de Nómina
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.reportes.index') }}" class="text-white-50">Reportes</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Generar</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Tarjeta principal -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <h5 class="m-0 font-weight-bold">
                    <i class="fas fa-user-clock mr-2"></i>Reporte por Empleado
                </h5>
            </div>

            <div class="card-body">
                <!-- Información del último reporte -->
                @if($ultimoReporte)
                    <div class="alert alert-primary alert-dismissible fade show rounded-lg shadow-sm" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fa-2x mr-3 text-primary"></i>
                            <div>
                                <h5 class="alert-heading mb-2">Último Reporte Generado</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="mb-1"><strong><i class="far fa-calendar-alt mr-2"></i>Fecha:</strong>
                                            {{ $ultimoReporte->fecha_reporte->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1"><strong><i class="fas fa-dollar-sign mr-2"></i>Total nómina:</strong>
                                            ${{ number_format($ultimoReporte->total_nomina, 2) }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-1"><strong><i class="fas fa-user-tie mr-2"></i>Generado por:</strong>
                                            {{ $ultimoReporte->creador->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Formulario -->
                <form action="{{ route('adminn.reportes.store') }}" method="POST" id="reporteForm">
                    @csrf

                    <div class="row mb-4">
                        <!-- Selección de empleado -->
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="form-group">
                                <label for="empleado_id" class="font-weight-bold text-primary mb-2">
                                    <i class="fas fa-user mr-2"></i>Seleccionar Empleado
                                </label>
                                <select class="form-control select2" id="empleado_id" name="empleado_id" required>
                                    <option value="">-- Seleccione un empleado --</option>
                                    @foreach($empleados as $emp)
                                        <option value="{{ $emp->ID_empleado }}" data-puesto="{{ $emp->puesto ? $emp->puesto->nombre_puesto : 'Sin puesto asignado' }}">
                                            {{ $emp->nombre }} {{ $emp->apellido_paterno }} {{ $emp->apellido_materno }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="empleadoHelp" class="form-text text-muted mt-1">
                                    <span id="puesto-seleccionado"></span>
                                </small>
                            </div>
                        </div>

                        <!-- Selección de semana -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="semana" class="font-weight-bold text-primary mb-2">
                                    <i class="fas fa-calendar-week mr-2"></i>Seleccionar Semana
                                </label>
                                <select class="form-control select2" id="semana" name="semana" required>
                                    <option value="">-- Seleccione la semana --</option>
                                    @foreach($semanasConDatos as $semana)
                                        <option value="{{ $semana->week }}"
                                                data-start="{{ $semana->start_date }}"
                                                data-end="{{ $semana->end_date }}">
                                            Semana {{ $semana->week }} ({{ date('d/m/Y', strtotime($semana->start_date)) }} al {{ date('d/m/Y', strtotime($semana->end_date)) }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted mt-1">Seleccione el periodo a reportar</small>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmación -->
                    <div class="form-group mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="confirmacion" name="confirmacion" required>
                            <label class="custom-control-label font-weight-bold text-primary" for="confirmacion">
                                <i class="fas fa-check-circle mr-2"></i>Confirmo que deseo generar un nuevo reporte de nómina
                            </label>
                            <small class="form-text text-muted d-block mt-1">
                                Al confirmar, se generará un reporte detallado con la información del empleado y periodo seleccionados.
                            </small>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between border-top pt-4">
                        <a href="{{ route('adminn.reportes.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left mr-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm" id="btnGenerar">
                            <i class="fas fa-calculator mr-2"></i> Generar Reporte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Estilos CSS Personalizados -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 8px);
            padding: 0.375rem 0.75rem;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 6px);
        }
        .custom-checkbox .custom-control-label::before {
            border-radius: 0.35rem;
        }
        .custom-control-input:checked ~ .custom-control-label::before {
            border-color: #4e73df;
            background-color: #4e73df;
        }
        .card {
            border-radius: 0.5rem;
        }
        .alert {
            border-left: 4px solid #4e73df;
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Inicializar Select2
                $('.select2').select2({
                    placeholder: $(this).data('placeholder'),
                    width: '100%'
                });

                // Mostrar puesto del empleado seleccionado
                $('#empleado_id').change(function() {
                    var puesto = $(this).find(':selected').data('puesto');
                    $('#puesto-seleccionado').html('<strong>Puesto:</strong> ' + puesto);
                });

                // Validación del formulario
                $('#reporteForm').submit(function(e) {
                    if (!$('#confirmacion').is(':checked')) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Confirmación requerida',
                            text: 'Debe confirmar que desea generar el reporte',
                            confirmButtonColor: '#4e73df'
                        });
                    }
                });

                // Deshabilitar botón al enviar
                $('#btnGenerar').click(function() {
                    $(this).prop('disabled', true);
                    $(this).html('<i class="fas fa-spinner fa-spin mr-2"></i> Procesando...');
                    $('#reporteForm').submit();
                });
            });
        </script>
    @endsection
@endsection
