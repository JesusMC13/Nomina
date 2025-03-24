@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="h3 mb-4 text-gray-800">Detalle del Turno</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $turno->nombre_turno }}</h6>
            </div>
            <div class="card-body">
                <p><strong>Hora de Entrada:</strong> {{ $turno->hora_entrada }}</p>
                <p><strong>Hora de Salida:</strong> {{ $turno->hora_salida }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('adminn.turnos.index') }}" class="btn btn-secondary">Regresar a la lista de turnos</a>
            </div>
        </div>
    </div>
@endsection
