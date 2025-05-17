@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-user-clock mr-2"></i>Asignar Turno
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.asignar.turnos') }}" class="text-white-50">Asignación Turnos</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Asignar Turno</li>
                    </ol>
                </nav>
            </div>
            <div>
                <span class="badge badge-light badge-pill shadow-sm text-primary">
                    <i class="fas fa-user mr-1"></i> {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}
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

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-calendar-alt mr-2"></i>Información del Turno
                        </h6>
                        <div>
                            <a href="{{ route('adminn.asignar.turnos') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminn.asignar.turnos.update', $empleado->ID_empleado) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 font-weight-bold">Empleado</label>
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
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 font-weight-bold">Turno Actual</label>
                                        <div class="d-flex align-items-center">
                                            @if($empleado->turno)
                                                <div class="mr-2">
                                                    <span class="badge badge-pill badge-soft-success">
                                                        {{ $empleado->turno->nombre_turno }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $empleado->turno->hora_entrada)->format('h:i A') }} -
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $empleado->turno->hora_salida)->format('h:i A') }}
                                                    </small>
                                                </div>
                                            @else
                                                <span class="badge badge-pill badge-soft-danger">
                                                    No asignado
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="turno_id" class="small mb-1 font-weight-bold">Seleccionar Nuevo Turno</label>
                                <select name="turno_id" id="turno_id" class="form-control select2" required>
                                    <option value="">-- Seleccione un turno --</option>
                                    @foreach($turnos as $turno)
                                        <option value="{{ $turno->ID_turno }}"
                                                {{ $empleado->turno_id == $turno->ID_turno ? 'selected' : '' }}
                                                data-hora-entrada="{{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada)->format('h:i A') }}"
                                                data-hora-salida="{{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salida)->format('h:i A') }}">
                                            {{ $turno->nombre_turno }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="card bg-light mb-4 border-0" id="turno-info" style="display: none;">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1 font-weight-bold" id="turno-nombre"></h6>
                                            <small class="text-muted" id="turno-horario"></small>
                                        </div>
                                        <div class="text-primary">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4 mb-0">
                                <button type="submit" class="btn btn-primary btn-block rounded-pill shadow-sm py-2">
                                    <i class="fas fa-save mr-1"></i> Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos CSS -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
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
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 8px);
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 8px);
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Inicializar Select2
                $('.select2').select2({
                    placeholder: "-- Seleccione un turno --",
                    allowClear: true
                });

                // Mostrar información del turno seleccionado
                $('#turno_id').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var horaEntrada = selectedOption.data('hora-entrada');
                    var horaSalida = selectedOption.data('hora-salida');

                    if (selectedOption.val()) {
                        $('#turno-nombre').text(selectedOption.text());
                        $('#turno-horario').text(horaEntrada + ' - ' + horaSalida);
                        $('#turno-info').fadeIn();
                    } else {
                        $('#turno-info').fadeOut();
                    }
                });

                // Disparar el cambio al cargar la página si ya hay un turno seleccionado
                if ($('#turno_id').val()) {
                    $('#turno_id').trigger('change');
                }
            });
        </script>
    @endsection
@endsection
