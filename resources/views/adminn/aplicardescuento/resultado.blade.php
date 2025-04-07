@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0">Resumen de Descuentos por Retardos</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <h5>Periodo:</h5>
                        <p><strong>Fecha Inicio:</strong> {{ $fechaInicio }}</p>
                        <p><strong>Fecha Fin:</strong> {{ $fechaFin }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Resumen General:</h5>
                        <p><strong>Total Empleados:</strong> {{ $resumen->total_empleados }}</p>
                        <p><strong>Total Retardos:</strong> {{ $resumen->total_retardos }}</p>
                        <p><strong>Total Minutos Retraso:</strong> {{ $resumen->total_minutos_retraso }}</p>
                        <p><strong>Total Descuentos:</strong> ${{ number_format($resumen->total_descuentos, 2) }}</p>
                    </div>
                </div>

                <a href="{{ route('adminn.aplicardescuento.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
@endsection
