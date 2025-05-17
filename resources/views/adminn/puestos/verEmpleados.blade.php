@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-users mr-2"></i>Asignación de Puestos
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Empleados y Puestos</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('admin.index') }}" class="btn btn-light rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Regresar
                </a>
            </div>
        </div>

        <!-- Tarjeta premium -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <div>
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-list-ol mr-2"></i>Relación de Empleados y Puestos
                    </h6>
                    <small class="font-weight-light">Listado completo de asignaciones</small>
                </div>
                <div>
                <span class="badge badge-pill badge-light shadow-sm">
                    <i class="fas fa-users mr-1"></i> {{ count($empleados) }} Empleados
                </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">EMPLEADO</th>
                            <th>PUESTO ASIGNADO</th>
                            <th class="text-center" style="width: 120px;">ESTADO</th>
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
                                            <h6 class="mb-0 font-weight-bold">{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h6>
                                            <small class="text-muted">{{ $empleado->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($empleado->puesto)
                                        <span class="d-flex align-items-center">
                                        <i class="fas fa-user-tie text-primary mr-2"></i>
                                        <span class="font-weight-bold">{{ $empleado->puesto->nombre_puesto }}</span>
                                        <small class="text-muted ml-2">(${{ number_format($empleado->puesto->salario_base, 2) }})</small>
                                    </span>
                                    @else
                                        <span class="text-muted">No asignado</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($empleado->puesto)
                                        <span class="badge badge-pill badge-soft-success py-1 px-3">
                                        <i class="fas fa-check-circle mr-1"></i> Asignado
                                    </span>
                                    @else
                                        <span class="badge badge-pill badge-soft-warning py-1 px-3">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Pendiente
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                        <h4 class="text-muted">No hay empleados registrados</h4>
                                        <p class="text-muted">No se encontraron empleados en el sistema</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light py-3">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            Mostrando <span class="font-weight-bold">1</span> a <span class="font-weight-bold">{{ count($empleados) }}</span> de <span class="font-weight-bold">{{ count($empleados) }}</span> registros
                        </p>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Page navigation" class="float-right">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .bg-light-primary {
            background-color: rgba(78, 115, 223, 0.1);
        }
        .bg-soft-primary {
            background-color: rgba(78, 115, 223, 0.2);
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        }
        .avatar-sm {
            width: 40px;
            height: 40px;
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
        .badge-soft-success {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }
        .badge-soft-warning {
            color: #ffc107;
            background-color: rgba(255, 193, 7, 0.1);
        }
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .empty-state {
            padding: 2rem;
            text-align: center;
        }
    </style>
@endsection
