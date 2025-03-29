@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="h3 mb-4 text-gray-800">Empleados</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <!-- Botón para Regresar al Dashboard -->
            <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Empleados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                                <tr>
                                    <td>{{ $empleado->nombre }}</td>
                                    <td>{{ $empleado->apellido_paterno }}</td>
                                    <td>{{ $empleado->apellido_materno }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
