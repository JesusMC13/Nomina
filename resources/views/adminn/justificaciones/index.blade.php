@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Botón de regreso al dashboard -->
        <div class="mb-3">
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Regresar al Dashboard
            </a>
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-clipboard-list mr-2"></i>Solicitudes de Justificación
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="filterDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-filter mr-1"></i>Filtrar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="filterDropdown">
                            <a class="dropdown-item" href="?estado=todos">Todos</a>
                            <div class="dropdown-divider"></div>
                            @foreach($estados as $estado)
                                <a class="dropdown-item" href="?estado={{ $estado->ID_estado }}">
                                    {{ $estado->nombre_estado }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>Empleado</th>
                            <th>Fecha</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Registro</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($justificaciones as $justificacion)
                            <tr>
                                <td>{{ $justificacion->empleado->nombre_completo }}</td>
                                <td>{{ $justificacion->fecha->format('d/m/Y') }}</td>
                                <td>{{ Str::limit($justificacion->motivo, 50) }}</td>
                                <td>
                                    <span class="badge
                                        @if($justificacion->estado->ID_estado == 2) badge-success
                                        @elseif($justificacion->estado->ID_estado == 3) badge-danger
                                        @else badge-warning @endif">
                                        {{ $justificacion->estado->nombre_estado }}
                                    </span>
                                </td>
                                <td>{{ $justificacion->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('adminn.justificaciones.show', $justificacion->ID_justificacion) }}"
                                           class="btn btn-sm btn-info mr-2" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($justificacion->estado->ID_estado == 1)
                                            <form method="POST" action="{{ route('adminn.justificaciones.estado', $justificacion->ID_justificacion) }}" class="mr-2">
                                                @csrf
                                                <input type="hidden" name="estado" value="2">
                                                <button type="submit" class="btn btn-sm btn-success" title="Aprobar">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('adminn.justificaciones.estado', $justificacion->ID_justificacion) }}">
                                                @csrf
                                                <input type="hidden" name="estado" value="3">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Rechazar">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle mr-2"></i> No hay justificaciones registradas
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $justificaciones->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
