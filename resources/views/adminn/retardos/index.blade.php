@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Retardos de Empleados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Empleados con Retardos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Hora de Entrada</th>
                                <th>Minutos de Retraso</th>
                                <th>Descuento Aplicado</th>
                                <th>Sueldo Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($retardos as $asistencia)
                                <tr>
                                    <td>{{ $asistencia->nombre }}</td>
                                    <td>{{ $asistencia->apellido_paterno }}</td>
                                    <td>{{ $asistencia->apellido_materno }}</td>
                                    <td>{{ $asistencia->hora_entrada }}</td>
                                    <td>{{ $asistencia->hora_entrada > $hora_tolerancia ? $hora_entrada->diffInMinutes($hora_programada) : 0 }} minutos</td>
                                    <td>
                                        @if ($asistencia->descuento_aplicado > 0)
                                            ${{ number_format($asistencia->descuento_aplicado, 2) }}
                                        @else
                                            No aplica
                                        @endif
                                    </td>
                                    <td>${{ number_format($asistencia->sueldo_total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
</div>
@endsection
