@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Asignar Turnos a Empleados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <!-- Botón para Regresar al Dashboard -->
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Regresar al Dashboard</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Empleados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="empleadosTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->nombre }} - {{ $empleado->apellido_paterno }}</td>
                            <td>
                                <a href="{{ route('adminn.asignar.turno', ['ID_empleado' => $empleado->ID_empleado]) }}" class="btn btn-primary btn-sm">Asignar turno</a>
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
