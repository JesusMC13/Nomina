<!-- resources/views/adminn/turnos/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Turnos</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('adminn.turnos.create') }}" class="btn btn-primary">Crear Turno</a>
        <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Turnos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre del Turno</th>
                            <th>Hora de Entrada</th>
                            <th>Hora de Salida</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($turnos as $turno)
                        <tr>
                            <td>{{ $turno->nombre_turno }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada)->format('g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salida)->format('g:i A') }}</td>
                            <td>
                                <a href="{{ route('adminn.turnos.edit', $turno->ID_turno) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('adminn.turnos.destroy', $turno->ID_turno) }}" method="POST" style="display:inline;">
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
