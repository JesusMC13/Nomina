@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-user-tie mr-2"></i>Nuevo Puesto
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.puestos.index') }}" class="text-white-50">Puestos</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Nuevo</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Tarjeta del formulario -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-body p-5">
                <form action="{{ route('adminn.puestos.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Sección de información básica -->
                    <div class="mb-5">
                        <h5 class="font-weight-bold text-primary mb-4">
                            <i class="fas fa-info-circle mr-2"></i>Información del Puesto
                        </h5>

                        <div class="form-group row">
                            <label for="nombre_puesto" class="col-md-3 col-form-label font-weight-bold">
                                Nombre del Puesto <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-user-tie text-primary"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control @error('nombre_puesto') is-invalid @enderror"
                                           id="nombre_puesto" name="nombre_puesto" required
                                           placeholder="Ej: Gerente de Ventas">
                                    @error('nombre_puesto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Ingrese el nombre completo del puesto
                                </small>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label for="salario_base" class="col-md-3 col-form-label font-weight-bold">
                                Salario Base <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-dollar-sign text-primary"></i>
                                    </span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control @error('salario_base') is-invalid @enderror"
                                           id="salario_base" name="salario_base" required
                                           placeholder="Ej: 15000.00">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    @error('salario_base')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Ingrese el salario base mensual
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between border-top pt-4">
                        <a href="{{ route('adminn.puestos.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left mr-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save mr-2"></i>Guardar Puesto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        }
        .form-control {
            border-radius: 0.35rem;
        }
        .input-group-text {
            background-color: #f8f9fa;
        }
        .needs-validation .was-validated .form-control:invalid,
        .needs-validation .form-control.is-invalid {
            border-color: #e74a3b;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23e74a3b' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e74a3b' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
    </style>

    <script>
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
    </script>
@endsection
