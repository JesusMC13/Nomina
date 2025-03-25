@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Retardos de Empleados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Empleados con Retardos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="retardosTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Fecha</th>
                            <th>Hora de Entrada</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($retardos as $retardo)
                        <tr>
                            <td>{{ $retardo->nombre }} {{ $retardo->apellido_paterno }} {{ $retardo->apellido_materno }}</td>
                            <td>{{ $retardo->fecha }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $retardo->hora_inicio)->format('g:i A') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
