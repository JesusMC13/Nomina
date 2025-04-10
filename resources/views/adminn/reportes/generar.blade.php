@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><i class="fas fa-file-invoice-dollar mr-2"></i> Generar Reporte de Nómina por Empleado</h3>
            </div>
            <div class="card-body">
                @if($ultimoReporte)
                    <div class="alert alert-info mb-4">
                        <h5><i class="fas fa-info-circle mr-2"></i> Último Reporte Generado</h5>
                        <p class="mb-1"><strong>Fecha:</strong> {{ $ultimoReporte->fecha_reporte->format('d/m/Y') }}</p>
                        <p class="mb-1"><strong>Total nómina:</strong> ${{ number_format($ultimoReporte->total_nomina, 2) }}</p>
                        <p class="mb-0"><strong>Generado por:</strong> {{ $ultimoReporte->creador->name }}</p>
                    </div>
                @endif

                <form action="{{ route('adminn.reportes.store') }}" method="POST">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="empleado_id" class="form-label">Seleccionar Empleado</label>
                            <select class="form-select" id="empleado_id" name="empleado_id" required>
                                <option value="">-- Seleccione un empleado --</option>
                                @foreach($empleados as $emp)
                                    <option value="{{ $emp->ID_empleado }}">
                                        {{ $emp->nombre }} {{ $emp->apellido_paterno }} {{ $emp->apellido_materno }} -
                                        @if($emp->puesto)
                                            {{ $emp->puesto->nombre_puesto }}
                                        @else
                                            Sin puesto asignado
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="semana" class="form-label">Seleccionar Semana</label>
                            <select class="form-select" id="semana" name="semana" required>
                                <option value="">-- Seleccione la semana --</option>
                                @foreach($semanasConDatos as $semana)
                                    <option value="{{ $semana->week }}"
                                            data-start="{{ $semana->start_date }}"
                                            data-end="{{ $semana->end_date }}">
                                        Semana {{ $semana->week }} ({{ date('d/m/Y', strtotime($semana->start_date)) }} al {{ date('d/m/Y', strtotime($semana->end_date)) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="confirmacion" name="confirmacion" required>
                            <label class="form-check-label" for="confirmacion">
                                Confirmo que deseo generar un nuevo reporte de nómina para el empleado y semana seleccionados
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-arrow-left mr-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calculator mr-2"></i> Generar Reporte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
