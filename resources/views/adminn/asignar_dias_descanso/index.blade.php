@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Lista de Empleados y Días de Descanso</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Empleados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="empleadosTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Días de Descanso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</td>
                                <td>
                                    @if ($empleado->dias_descanso)
                                        @try
                                            @php
                                                $diasDescanso = json_decode($empleado->dias_descanso, true); // Decodifica a un array asociativo
                                            @endphp
                                            @if (is_array($diasDescanso) && count($diasDescanso) > 0)
                                                {{ implode(', ', $diasDescanso) }}
                                            @elseif (is_array($diasDescanso) && count($diasDescanso) === 0)
                                                Ninguno seleccionado
                                            @else
                                                Error al decodificar
                                            @endif
                                        @catch (Exception $e)
                                            Error al decodificar (Excepción)
                                        @endtry
                                    @else
                                        No asignado
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('adminn.asignar.dias.descanso.form', ['ID_empleado' => $empleado->ID_empleado]) }}" class="btn btn-primary">Asignar Días de Descanso</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
