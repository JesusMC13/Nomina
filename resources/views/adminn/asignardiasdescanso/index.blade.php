@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-calendar-minus mr-2"></i>Gestión de Días de Descanso
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Días de Descanso</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow-sm text-primary">
                <i class="fas fa-users mr-1"></i> {{ count($empleados) }} Empleados
            </span>
            </div>
        </div>

        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-list-ul mr-2"></i>Asignaciones Actuales
                </h6>
                <div>
                    <a href="{{ route('adminn.asignardiasdescanso.create') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
                        <i class="fas fa-plus mr-1"></i> Nuevo Día de Descanso
                    </a>
                    <a href="{{ route('admin.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm ml-2">
                        <i class="fas fa-arrow-left mr-1"></i> Dashboard
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" width="100%" cellspacing="0">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">EMPLEADO</th>
                            <th>DÍAS DE DESCANSO</th>
                            <th class="text-center" style="width: 180px;">ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($empleados as $empleado)
                            <tr>
                                <td class="pl-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm mr-3">
                                            <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                                {{ substr($empleado->nombre, 0, 1) }}{{ substr($empleado->apellido_paterno, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">{{ $empleado->nombre }}</h6>
                                            <small class="text-muted">{{ $empleado->apellido_paterno }} {{ $empleado->apellido_materno }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($empleado->diasDescanso->count() > 0)
                                        @foreach($empleado->diasDescanso as $dia)
                                            <span class="badge badge-pill badge-soft-info mr-1">
                                                {{ $dia->nombre_dia }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="badge badge-pill badge-soft-warning">
                                            Sin días asignados
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('adminn.asignardiasdescanso.edit', $empleado->ID_empleado) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3 mr-1"
                                       data-toggle="tooltip" title="Editar días de descanso">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                    <form action="{{ route('adminn.asignardiasdescanso.destroy', $empleado->ID_empleado) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar estos días de descanso?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                data-toggle="tooltip" title="Eliminar asignación">
                                            <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-calendar-times fa-3x mb-3 text-muted"></i>
                                        <h5 class="font-weight-bold">No hay asignaciones registradas</h5>
                                        <p class="mb-0">Comience asignando días de descanso a los empleados</p>
                                        <a href="{{ route('adminn.asignardiasdescanso.create') }}"
                                           class="btn btn-primary mt-3 rounded-pill shadow-sm">
                                            <i class="fas fa-plus mr-1"></i> Crear Asignación
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .bg-light-primary {
            background-color: rgba(78, 115, 223, 0.1);
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        }
        .avatar-sm {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            font-size: 0.875rem;
        }
        .badge-soft-info {
            color: #17a2b8;
            background-color: rgba(23, 162, 184, 0.1);
        }
        .badge-soft-warning {
            color: #ffc107;
            background-color: rgba(255, 193, 7, 0.1);
        }
        .badge-soft-danger {
            color: #e74a3b;
            background-color: rgba(231, 74, 59, 0.1);
        }
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .empty-state {
            opacity: 0.6;
            padding: 2rem 0;
        }
        .btn-rounded {
            border-radius: 50px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
