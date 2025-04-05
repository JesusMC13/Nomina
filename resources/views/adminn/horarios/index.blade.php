@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Horarios por Turno</h6>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <!-- Botón para Regresar al Dashboard -->
                <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
            </div>
            <div class="card-body">
                <form action="{{ route('adminn.horarios.buscar') }}" method="GET" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <input type="text" name="nombre" class="form-control" placeholder="Buscar empleado..."
                                   value="{{ request('nombre') }}" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <select name="puesto" class="form-control">
                                <option value="">Todos los puestos</option>
                                @foreach($puestosUnicos as $id => $puesto)
                                    <option value="{{ $id }}" {{ request('puesto') == $id ? 'selected' : '' }}>
                                        {{ $puesto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="turno" class="form-control">
                                <option value="">Todos los turnos</option>
                                @foreach($turnosUnicos as $id => $turno)
                                    <option value="{{ $id }}" {{ request('turno') == $id ? 'selected' : '' }}>
                                        {{ $turno }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="thead-light">
                        <tr>
                            <th width="25%">Empleado</th>
                            <th width="20%">Puesto</th>
                            <th width="15%">Turno</th>
                            <th width="10%">Entrada</th>
                            <th width="10%">Salida</th>
                            <th width="10%">Tolerancia</th>
                            <th width="10%">Días Laborales</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($horarios as $empleado)
                            <tr>
                                <td>
                                    <strong>{{ $empleado->nombre_completo }}</strong>
                                    @if($empleado->user)
                                        <br><small class="text-muted">{{ $empleado->user->email }}</small>
                                    @endif
                                </td>
                                <td>{{ $empleado->puesto->nombre_puesto ?? 'No asignado' }}</td>
                                <td>
                                    @if($empleado->turno)
                                        <span class="badge badge-primary">
                                            {{ $empleado->turno->nombre_turno }}
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">No asignado</span>
                                    @endif
                                </td>
                                <td class="text-monospace">
                                    @php
                                        $horaEntrada = $empleado->hora_entrada ?: ($empleado->turno->hora_entrada ?? null);
                                        echo $horaEntrada ? date('h:i A', strtotime($horaEntrada)) : '--:--';
                                    @endphp
                                </td>
                                <td class="text-monospace">
                                    @php
                                        $horaSalida = $empleado->turno->hora_salida ?? null;
                                        echo $horaSalida ? date('h:i A', strtotime($horaSalida)) : '--:--';
                                    @endphp
                                </td>
                                <td>{{ $empleado->turno->tolerancia_minutos ?? 0 }} mins</td>
                                <td>{{ $empleado->turno->dias_laborales ?? 'No definido' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-user-slash fa-2x mb-2 text-muted"></i>
                                    <p class="mb-0">No se encontraron empleados</p>
                                    @if(request()->hasAny(['nombre', 'puesto', 'turno']))
                                        <a href="{{ route('adminn.horarios.index') }}" class="btn btn-sm btn-link mt-2">
                                            Limpiar filtros
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $horarios->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .badge {
            font-size: 0.85em;
            font-weight: 600;
            padding: 0.35em 0.65em;
        }
        .table th {
            white-space: nowrap;
            position: sticky;
            top: 0;
            background: #f8f9fa;
        }
        .table td {
            vertical-align: middle;
        }
        .text-monospace {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-weight: bold;
        }
        .empty-state {
            opacity: 0.6;
        }
    </style>
@endsection
