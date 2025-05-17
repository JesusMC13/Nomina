@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium con gradiente -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-user-tie mr-2"></i>Gestión de Puestos
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Puestos</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow">
                <i class="fas fa-briefcase mr-1"></i> {{ count($puestos) }} Puestos
            </span>
            </div>
        </div>

        <!-- Mensaje flash premium -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bg-success rounded-circle p-2 mr-3">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">¡Éxito!</h6>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <!-- Tarjeta premium -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-body p-0">
                <!-- Barra de herramientas -->
                <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                    <div>
                        <h6 class="mb-0 font-weight-bold text-primary">
                            <i class="fas fa-list-ul mr-2"></i>Registro de Puestos
                        </h6>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('adminn.puestos.create') }}" class="btn btn-success btn-sm rounded-pill shadow-sm mr-2">
                            <i class="fas fa-plus mr-2"></i>Nuevo Puesto
                        </a>
                        <a href="{{ route('admin.index') }}" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left mr-2"></i>Dashboard
                        </a>
                    </div>
                </div>

                <!-- Tabla premium simplificada -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="border-0 font-weight-bold pl-4">PUESTO</th>
                            <th class="border-0 font-weight-bold text-right pr-4">SALARIO BASE</th>
                            <th class="border-0 font-weight-bold text-center" style="width: 120px;">ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($puestos as $puesto)
                            <tr class="border-bottom">
                                <td class="pl-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-soft-primary rounded-circle p-2 mr-3">
                                            <i class="fas fa-user-tie text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">{{ $puesto->nombre_puesto }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right pr-4">
                                    <span class="font-weight-bold text-success">${{ number_format($puesto->salario_base, 2) }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('adminn.puestos.edit', $puesto->id_puesto) }}" class="btn btn-sm btn-outline-warning rounded-circle mr-2" data-toggle="tooltip" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('adminn.puestos.destroy', $puesto->id_puesto) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Confirmar eliminación?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon bg-soft-primary rounded-circle">
                                            <i class="fas fa-user-tie text-primary fa-3x"></i>
                                        </div>
                                        <h4 class="mt-3 font-weight-bold">No hay puestos registrados</h4>
                                        <p class="text-muted mb-4">Comienza agregando nuevos puestos a tu organización</p>
                                        <a href="{{ route('adminn.puestos.create') }}" class="btn btn-primary rounded-pill px-4">
                                            <i class="fas fa-plus mr-2"></i>Crear Puesto
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
        .empty-state {
            padding: 3rem;
            text-align: center;
        }
        .empty-state-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        .table td {
            vertical-align: middle;
        }
        .btn-circle {
            width: 32px;
            height: 32px;
            padding: 0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }
    </style>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
