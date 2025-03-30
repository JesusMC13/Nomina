
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Asignar Turnos a Empleados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Empleados</h6>
        </div>
        <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Turno Actual</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</td>
                    <td>
                        @if($empleado->turno)
                            {{ $empleado->turno->nombre_turno }}
                        @else
                            <span class="text-muted">No asignado</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('adminn.asignar.turno.form', $empleado->ID_empleado) }}" class="btn btn-primary">Asignar Turno</a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
