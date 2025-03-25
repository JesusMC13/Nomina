@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Resultado del Descuento Aplicado</h2>

    @if(session('empleado') && session('descuento'))
        @php
            $empleado = session('empleado');
            $descuento = session('descuento');
        @endphp

        <div class="card shadow-sm">
            <div class="card-body">
                <h4>Empleado: {{ $empleado->nombre }}</h4>
                <p><strong>Puesto:</strong> {{ $empleado->puesto ? $empleado->puesto->nombre_puesto : 'Sin puesto asignado' }}</p>
                <p><strong>Descuento Aplicado:</strong> ${{ number_format($descuento, 2) }}</p>
                <p><strong>Sueldo Total Antes de Descuento:</strong> ${{ number_format($empleado->sueldo_total, 2) }}</p>
                <p><strong>Sueldo Después de Descuento:</strong> ${{ number_format($empleado->sueldo_total - $descuento, 2) }}</p>
            </div>
        </div>
    @else
        <div class="alert alert-danger">No se pudo aplicar el descuento. Por favor, intenta nuevamente.</div>
    @endif
</div>
@endsection
