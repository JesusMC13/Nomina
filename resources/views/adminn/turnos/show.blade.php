@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado mejorado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3">
            <div>
                <h2 class="h3 mb-1 text-gray-800 font-weight-bold">
                    <i class="fas fa-clock text-primary mr-2"></i>Detalle del Turno
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminn.turnos.index') }}">Turnos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                    </ol>
                </nav>
            </div>
            <span class="badge badge-primary badge-pill">
            ID: {{ $turno->ID_turno }}
        </span>
        </div>

        <!-- Tarjeta de detalle mejorada -->
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle mr-2"></i>{{ $turno->nombre_turno }}
                </h6>
                <div>
                    <a href="{{ route('adminn.turnos.edit', $turno->ID_turno) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit mr-1"></i>Editar
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="detail-card p-3 h-100">
                            <h5 class="font-weight-bold text-primary mb-3">
                                <i class="fas fa-sign-in-alt mr-2"></i>Hora de Entrada
                            </h5>
                            <div class="time-display bg-light p-3 rounded text-center">
                            <span class="h4 font-weight-bold">
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada)->format('h:i A') }}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="detail-card p-3 h-100">
                            <h5 class="font-weight-bold text-primary mb-3">
                                <i class="fas fa-sign-out-alt mr-2"></i>Hora de Salida
                            </h5>
                            <div class="time-display bg-light p-3 rounded text-center">
                            <span class="h4 font-weight-bold">
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salida)->format('h:i A') }}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="detail-card p-3">
                            <h5 class="font-weight-bold text-primary mb-3">
                                <i class="fas fa-hourglass-half mr-2"></i>Duración del Turno
                            </h5>
                            @php
                                $entrada = \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada);
                                $salida = \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salida);
                                $duracion = $entrada->diff($salida)->format('%h horas %i minutos');
                            @endphp
                            <div class="duration-display bg-light p-3 rounded text-center">
                                <span class="h5 font-weight-bold">{{ $duracion }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white py-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('adminn.turnos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Volver a la lista
                    </a>
                    <small class="text-muted">
                        Actualizado: {{ $turno->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <style>
        .detail-card {
            border-left: 4px solid #4e73df;
        }
        .time-display {
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .duration-display {
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }
    </style>
@endsection
