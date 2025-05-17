@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-user-tie mr-2"></i>Asignar Puestos
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.puestos.index') }}" class="text-white-50">Puestos</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Asignar</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Tarjeta del formulario -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-body p-5">
                <form action="{{ route('adminn.asignar.puestos.assign') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Sección de selección -->
                    <div class="mb-5">
                        <h5 class="font-weight-bold text-primary mb-4">
                            <i class="fas fa-users-cog mr-2"></i>Asignar Puesto a Empleado
                        </h5>

                        <!-- Selector de Empleado -->
                        <div class="form-group row">
                            <label for="empleado_id" class="col-md-3 col-form-label font-weight-bold">
                                Seleccionar Empleado <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-user text-primary"></i>
                                    </span>
                                    </div>
                                    <select name="empleado_id" id="empleado_id" class="form-control select2 @error('empleado_id') is-invalid @enderror" required>
                                        <option value="">-- Seleccione un empleado --</option>
                                        @foreach($empleados as $empleado)
                                            <option value="{{ $empleado->ID_empleado }}">
                                                {{ $empleado->nombre }} {{ $empleado->apellido_paterno }} {{ $empleado->apellido_materno }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('empleado_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Busque y seleccione el empleado a asignar
                                </small>
                            </div>
                        </div>

                        <!-- Selector de Puesto -->
                        <div class="form-group row mt-4">
                            <label for="puesto_id" class="col-md-3 col-form-label font-weight-bold">
                                Seleccionar Puesto <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-briefcase text-primary"></i>
                                    </span>
                                    </div>
                                    <select name="puesto_id" id="puesto_id" class="form-control select2 @error('puesto_id') is-invalid @enderror" required>
                                        <option value="">-- Seleccione un puesto --</option>
                                        @foreach($puestos as $puesto)
                                            <option value="{{ $puesto->id_puesto }}">
                                                {{ $puesto->nombre_puesto }} (Salario: ${{ number_format($puesto->salario_base, 2) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('puesto_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Seleccione el puesto a asignar al empleado
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between border-top pt-4">
                        <a href="{{ route('adminn.puestos.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left mr-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            <i class="fas fa-check-circle mr-2"></i>Asignar Puesto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Estilos CSS -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        }
        .select2-container--default .select2-selection--single {
            height: calc(1.5em + 0.75rem + 2px);
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + 0.75rem + 2px);
        }
        .input-group-text {
            background-color: #f8f9fa;
        }
    </style>

    <!-- Scripts -->
    @section('scripts')
        <!-- Select2 para selects mejorados -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: 'Seleccione una opción',
                    allowClear: true,
                    width: '100%'
                });

                // Validación de formulario
                (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                        var forms = document.getElementsByClassName('needs-validation');
                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                        });
                    }, false);
                })();
            });
        </script>
    @endsection
@endsection
