@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('empleado.dashboard') }}" class="btn btn-light btn-sm mr-2" title="Regresar al dashboard">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h3 class="mb-0 d-inline-block"><i class="fas fa-file-invoice-dollar mr-2"></i> Mis Descuentos</h3>
                    </div>
                    <span class="badge bg-light text-dark">
                        {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                @if($descuentos->isEmpty())
                    <div class="alert alert-info">
                        No tienes descuentos registrados.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Monto</th>
                                <th>Detalle</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($descuentos as $descuento)
                                <tr>
                                    <td>{{ $descuento->fecha->format('d/m/Y') }}</td>
                                    <td>{{ ucfirst($descuento->tipo_descuento) }}</td>
                                    <td class="text-danger">-${{ number_format($descuento->monto, 2) }}</td>
                                    <td>
                                        @if(isset($descuento->es_calculado))
                                            <span class="badge bg-warning text-dark">Retardo: {{ $descuento->minutos_retraso }} min</span>
                                        @else
                                            {{ $descuento->comentarios }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('empleado.descuentos.show', $descuento->ID_descuento) }}"
                                           class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $descuentos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
