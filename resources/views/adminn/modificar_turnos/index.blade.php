@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="h3 mb-4 text-gray-800 text-center">Modificar Turnos Semanalmente</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h6 class="m-0 font-weight-bold">Lista de Empleados</h6>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Turno Actual</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</td>
                            <td>{{ $empleado->turno ?? 'No asignado' }}</td>
                            <td>
                                <a href="{{ route('adminn.modificar.turno.form', $empleado->ID_empleado) }}" class="btn btn-sm btn-warning">
                                    Modificar Turno
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
