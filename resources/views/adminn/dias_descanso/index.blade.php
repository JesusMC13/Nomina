@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="h3 mb-4 text-gray-800">Días de Descanso</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="d-flex justify-content-between mb-3">

        <!-- Botón para Crear un Nuevo Día de Descanso -->
        <a href="{{ route('adminn.dias_descanso.create') }}" class="btn btn-primary">Crear Día de Descanso</a>
        
        <!-- Botón para Regresar al Dashboard -->
        <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
    </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Días de Descanso</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diasDescanso as $dia)
                                <tr>
                                    <td>{{ $dia->nombre_dia }}</td>
                                    <td>
                                        <a href="{{ route('adminn.dias_descanso.edit', $dia->ID_dia_descanso) }}" class="btn btn-warning btn-sm">Editar</a>

                                        <form action="{{ route('adminn.dias_descanso.destroy', $dia->ID_dia_descanso) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
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
