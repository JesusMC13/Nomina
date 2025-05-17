@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado con estilo azul bajito -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 text-gray-800 font-weight-bold mb-0">
                    <i class="fas fa-users mr-2 text-primary"></i>Gestión de Empleados
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mt-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Empleados</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.index') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i>Volver al Panel
            </a>
        </div>

        <!-- Mensaje flash mejorado -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-lg mr-3"></i>
                    <div>
                        <h5 class="alert-heading mb-1">¡Operación Exitosa!</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Tarjeta con azul bajito -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <div>
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-id-card-alt mr-2"></i>Registro de Empleados
                    </h6>
                    <small class="font-weight-light">Lista completa del personal registrado</small>
                </div>
                <div>
                    <span class="badge badge-pill badge-light shadow-sm">
                        <i class="fas fa-users mr-1"></i> Total: {{ count($empleados) }}
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th class="text-center">Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm mr-3">
                                                <span class="avatar-title bg-soft-primary rounded-circle text-primary font-weight-bold">
                                                    {{ substr($empleado->nombre, 0, 1) }}
                                                </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $empleado->nombre }}</h6>
                                            <small class="text-muted">{{ $empleado->email ?? 'Sin email' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $empleado->apellido_paterno }}</td>
                                <td>{{ $empleado->apellido_materno }}</td>
                                <td class="text-center">
                                        <span class="badge badge-pill badge-soft-success py-1 px-3">
                                            <i class="fas fa-circle mr-1" style="font-size: 6px;"></i> Activo
                                        </span>
                                </td>
                            </tr>
                        @endforeach
                        @if(count($empleados) === 0)
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                        <h4 class="text-muted">No se encontraron empleados</h4>
                                        <p class="text-muted">Parece que no hay ningún empleado registrado aún.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light py-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="showing-entries">
                            <p>Mostrando <span>1</span> a <span>{{ count($empleados) }}</span> de <span>{{ count($empleados) }}</span> registros</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
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
        }
        .badge-soft-success {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.05);
        }
        .card-header {
            background-color: #4e73df !important; /* Azul más suave */
        }
        .empty-state {
            padding: 2rem;
            text-align: center;
        }
        .table th {
            border-top: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            background-color: #f8f9fa;
        }
        .table td {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05); /* Hover azul muy suave */
        }
    </style>
@endsection
