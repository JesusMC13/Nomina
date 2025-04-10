@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Dashboard
                        </a>
                        <h3 class="mb-0 d-inline-block">
                            <i class="fas fa-clock mr-2"></i> Descuentos por Retardos
                        </h3>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark">
                            {{ $totalEmpleados }} empleados
                            <span class="badge bg-warning text-dark ms-2">{{ $totalRetardos }} retardos</span>
                            <span class="badge bg-danger ms-2">${{ number_format($totalDescuentos, 2) }} descuentos</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control"
                                   value="{{ $fechaInicio }}">
                        </div>
                        <div class="col-md-5">
                            <label for="fecha_fin">Fecha Fin</label>
                            <input type="date" name="fecha_fin" class="form-control"
                                   value="{{ $fechaFin }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </form>

                @if($empleados->isEmpty())
                    <div class="alert alert-info">
                        No se encontraron retardos en el período seleccionado.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>Empleado</th>
                                <th>Puesto</th>
                                <th>Retardos</th>
                                <th>Descuento Total</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($empleados as $emp)
                                @if($emp->total_retardos > 0)
                                    <tr>
                                        <td>{{ $emp->nombre }} {{ $emp->apellido_paterno }}</td>
                                        <td>{{ $emp->puesto->nombre_puesto }}</td>
                                        <td class="text-center">{{ $emp->total_retardos }}</td>
                                        <td class="text-danger">${{ number_format($emp->total_descuento, 2) }}</td>
                                        <td>
                                            <a href="{{ route('adminn.aplicardescuento.detalle', $emp->ID_empleado) }}?fecha_inicio={{ $fechaInicio }}&fecha_fin={{ $fechaFin }}"
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detalle
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .table td, .table th {
            vertical-align: middle;
        }
        .badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }
    </style>
@endsection
