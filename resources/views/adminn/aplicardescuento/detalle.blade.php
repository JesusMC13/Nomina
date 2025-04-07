@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalle de Retardos: {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h2>
        <h4>Puesto: {{ $empleado->puesto->nombre_puesto }}</h4>
        <h4>Total Descuentos: ${{ number_format($total_descuento, 2) }}</h4>

        <div class="mb-3">
            <a href="{{ route('adminn.aplicardescuento.index') }}" class="btn btn-secondary">
                ← Regresar al listado
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Turno</th>
                    <th>Hora Esperada</th>
                    <th>Hora Llegada</th>
                    <th>Minutos Retardo</th>
                    <th>Descuento</th>
                    <th>Detalle Cálculo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($retardos as $retardo)
                    <tr>
                        <td>{{ $retardo['fecha'] }}</td>
                        <td>{{ $retardo['turno'] }}</td>
                        <td>{{ $retardo['hora_esperada'] }}</td>
                        <td>{{ $retardo['hora_llegada'] }}</td>
                        <td>{{ $retardo['minutos_retraso'] }}</td>
                        <td>${{ number_format($retardo['descuento'], 2) }}</td>
                        <td>{{ $retardo['detalle_calculo'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
