@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-calendar-plus mr-2"></i>Asignar Días de Descanso
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.empleados.index') }}" class="text-white-50">Empleados</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.asignardiasdescanso.index') }}" class="text-white-50">Descansos</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Asignar</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Tarjeta de formulario -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <h5 class="m-0 font-weight-bold">
                    <i class="fas fa-user-plus mr-2"></i>Nueva Asignación de Descanso
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('adminn.asignardiasdescanso.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="empleado_id" class="font-weight-bold text-primary mb-2">
                                    <i class="fas fa-user mr-2"></i>Seleccione Empleado
                                </label>
                                <select name="empleado_id" id="empleado_id" class="form-control form-control-lg border-primary" required>
                                    <option value="" disabled selected>-- Seleccione un empleado --</option>
                                    @foreach($empleados as $empleado)
                                        <option value="{{ $empleado->ID_empleado }}">
                                            {{ $empleado->nombre }} {{ $empleado->apellido_paterno }} - {{ $empleado->puesto->nombre_puesto }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="dia_descanso_id" class="font-weight-bold text-primary mb-2">
                                    <i class="fas fa-calendar-day mr-2"></i>Seleccione Día de Descanso
                                </label>
                                <select name="dia_descanso_id" id="dia_descanso_id" class="form-control form-control-lg border-primary" required>
                                    <option value="" disabled selected>-- Seleccione un día --</option>
                                    @foreach($dias as $dia)
                                        <option value="{{ $dia->ID_dia_descanso }}">{{ $dia->nombre_dia }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('adminn.asignardiasdescanso.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save mr-2"></i> Asignar Día
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
        .border-primary {
            border-color: #4e73df !important;
        }
        .form-control-lg {
            height: calc(2.875rem + 2px);
            padding: 0.5rem 1rem;
            font-size: 1.1rem;
        }
        .card {
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .form-group label {
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
    </style>

    <!-- Script para select2 (opcional) -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Opcional: Inicializar select2 para búsqueda en los selects
                $('#empleado_id, #dia_descanso_id').select2({
                    placeholder: $(this).data('placeholder'),
                    width: '100%'
                });
            });
        </script>
    @endsection
@endsection
