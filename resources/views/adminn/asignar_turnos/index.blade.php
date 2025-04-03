@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Asignación de Turnos</h1>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-warning">
                <h6 class="m-0 font-weight-bold text-white">Lista de Empleados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Turno Actual</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->nombre }}</td>
                                <td>{{ $empleado->apellido_paterno }} {{ $empleado->apellido_materno }}</td>
                                <td>
                                    @if($empleado->turno)
                                        {{ $empleado->turno->nombre_turno }}
                                        ({{ $empleado->turno->hora_entrada }} - {{ $empleado->turno->hora_salida }})
                                    @else
                                        <span class="text-danger">No asignado</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('adminn.asignar.turnos.show', $empleado->ID_empleado) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Asignar/Modificar
                                    </a>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                }
            });
        });
    </script>
@endsection
