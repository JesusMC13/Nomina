@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Aplicar Descuento por Retardo</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-4">
        <!-- Botón para Regresar al Dashboard -->
        <a href="{{ route('admin.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Regresar al Dashboard</a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Vista para aplicar el descuento -->
            <form action="{{ route('adminn.aplicardescuento.aplicarDescuento') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="empleado_id">Empleado</label>
                    <select name="empleado_id" id="empleado_id" class="form-control">
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}">
                            {{ $empleado->nombre }} - 
                            <!-- Mostrar el nombre del puesto -->
                            {{ $empleado->puesto ? $empleado->puesto->nombre_puesto : 'Sin puesto asignado' }}
                            (Retraso: {{ now()->diffInMinutes($empleado->hora_entrada) }} minutos)
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="minutos_retraso">Minutos de retraso</label>
                    <input type="number" name="minutos_retraso" id="minutos_retraso" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Aplicar Descuento</button>
            </form>

        </div>
    </div>

    <hr>

    <h3>Listado de Empleados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Puesto</th>
                <th>Turno</th>
                <th>Retraso (minutos)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }} {{ $empleado->apellido_paterno }} {{ $empleado->apellido_materno }}</td>
                    <td>
                        @if($empleado->puesto)
                            {{ $empleado->puesto->nombre_puesto }} <!-- Muestra el puesto del empleado -->
                        @else
                            Sin puesto asignado
                        @endif
                    </td>
                    <td>{{ $empleado->turno }}</td> <!-- Muestra el turno del empleado -->
                    <td>
                        @if($empleado->hora_entrada)
                            {{ now()->diffInMinutes($empleado->hora_entrada) }} <!-- Calcula el retraso en minutos -->
                        @else
                            Sin registro de hora de entrada
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
