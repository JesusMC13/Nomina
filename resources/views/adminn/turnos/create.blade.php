@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-clock mr-2"></i>Nuevo Turno
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.turnos.index') }}" class="text-white-50">Turnos</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Nuevo</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Tarjeta del formulario -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-body p-5">
                <form action="{{ route('adminn.turnos.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Sección de información básica -->
                    <div class="mb-5">
                        <h5 class="font-weight-bold text-primary mb-4">
                            <i class="fas fa-plus-circle mr-2"></i>Información del Turno
                        </h5>

                        <!-- Campo Nombre del Turno -->
                        <div class="form-group row">
                            <label for="nombre_turno" class="col-md-3 col-form-label font-weight-bold">
                                Nombre del Turno <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-clock text-primary"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control @error('nombre_turno') is-invalid @enderror"
                                           id="nombre_turno" name="nombre_turno"
                                           value="{{ old('nombre_turno') }}"
                                           required placeholder="Ej: Turno Matutino">
                                    @error('nombre_turno')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Ingrese un nombre descriptivo para el turno
                                </small>
                            </div>
                        </div>

                        <!-- Campo Hora de Entrada -->
                        <div class="form-group row mt-4">
                            <label for="hora_entrada" class="col-md-3 col-form-label font-weight-bold">
                                Hora de Entrada <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-sign-in-alt text-primary"></i>
                                    </span>
                                    </div>
                                    <input type="time" class="form-control @error('hora_entrada') is-invalid @enderror"
                                           id="hora_entrada" name="hora_entrada"
                                           value="{{ old('hora_entrada') }}"
                                           required>
                                    @error('hora_entrada')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Seleccione la hora de inicio del turno
                                </small>
                            </div>
                        </div>

                        <!-- Campo Hora de Salida -->
                        <div class="form-group row mt-4">
                            <label for="hora_salida" class="col-md-3 col-form-label font-weight-bold">
                                Hora de Salida <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-sign-out-alt text-primary"></i>
                                    </span>
                                    </div>
                                    <input type="time" class="form-control @error('hora_salida') is-invalid @enderror"
                                           id="hora_salida" name="hora_salida"
                                           value="{{ old('hora_salida') }}"
                                           required>
                                    @error('hora_salida')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Seleccione la hora de finalización del turno
                                </small>
                            </div>
                        </div>

                        <!-- Visualización de duración -->
                        <div class="form-group row mt-4">
                            <label class="col-md-3 col-form-label font-weight-bold">
                                Duración
                            </label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-hourglass-half text-primary"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control bg-white"
                                           id="duracion_turno" readonly
                                           placeholder="Se calculará automáticamente">
                                </div>
                                <small class="form-text text-muted">
                                    Duración calculada automáticamente
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between border-top pt-4">
                        <a href="{{ route('adminn.turnos.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save mr-2"></i>Guardar Turno
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

    <!-- Scripts -->
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

        // Cálculo automático de duración al cambiar horas
        document.addEventListener('DOMContentLoaded', function() {
            const horaEntrada = document.getElementById('hora_entrada');
            const horaSalida = document.getElementById('hora_salida');
            const duracionTurno = document.getElementById('duracion_turno');

            function calcularDuracion() {
                if (horaEntrada.value && horaSalida.value) {
                    const entrada = new Date(`2000-01-01T${horaEntrada.value}:00`);
                    const salida = new Date(`2000-01-01T${horaSalida.value}:00`);

                    // Si la salida es menor que la entrada, asumimos que es al día siguiente
                    if (salida <= entrada) {
                        salida.setDate(salida.getDate() + 1);
                    }

                    const diffMs = salida - entrada;
                    const diffHrs = Math.floor((diffMs % 86400000) / 3600000);
                    const diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000);

                    duracionTurno.value = `${diffHrs} horas ${diffMins} minutos`;
                }
            }

            horaEntrada.addEventListener('change', calcularDuracion);
            horaSalida.addEventListener('change', calcularDuracion);
        });
    </script>
@endsection
