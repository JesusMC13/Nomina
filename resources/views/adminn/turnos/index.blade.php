@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado premium -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-clock mr-2"></i>Gestión de Turnos
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Turnos</li>
                    </ol>
                </nav>
            </div>
            <div>
            <span class="badge badge-light badge-pill shadow-sm">
                <i class="fas fa-clock mr-1"></i> {{ count($turnos) }} Turnos
            </span>
            </div>
        </div>

        <!-- Mensaje flash premium -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bg-success rounded-circle p-2 mr-3">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold">¡Operación Exitosa!</h6>
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
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-list-ul mr-2"></i>Registro de Turnos
                </h6>
                <div>
                    <a href="{{ route('adminn.turnos.create') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
                        <i class="fas fa-plus mr-2"></i>Nuevo Turno
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light-primary">
                        <tr>
                            <th class="pl-4">TURNO</th>
                            <th>HORARIO</th>
                            <th class="text-center">DURACIÓN</th>
                            <th class="text-center" style="width: 150px;">ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($turnos as $turno)
                            <tr>
                                <td class="pl-4 font-weight-bold">{{ $turno->nombre_turno }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                    <span class="badge badge-success mr-3">
                                        <i class="fas fa-sign-in-alt mr-1"></i> {{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada)->format('g:i A') }}
                                    </span>
                                        <span class="text-muted mr-1">a</span>
                                        <span class="badge badge-danger">
                                        <i class="fas fa-sign-out-alt mr-1"></i> {{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salida)->format('g:i A') }}
                                    </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $entrada = \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada);
                                        $salida = \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salida);
                                        $duracion = $entrada->diff($salida)->format('%h h %i min');
                                    @endphp
                                    <span class="badge badge-primary">{{ $duracion }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('adminn.turnos.edit', $turno->ID_turno) }}" class="btn btn-outline-warning rounded-circle mr-1" data-toggle="tooltip" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('adminn.turnos.destroy', $turno->ID_turno) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger rounded-circle" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Confirmar eliminación?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                                        <h4 class="text-muted">No hay turnos registrados</h4>
                                        <p class="text-muted">Comienza creando nuevos turnos para tu organización</p>
                                        <a href="{{ route('adminn.turnos.create') }}" class="btn btn-primary rounded-pill px-4">
                                            <i class="fas fa-plus mr-2"></i>Crear Turno
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-arrow-left mr-2"></i>Regresar al Dashboard
                        </a>
                    </div>
                    @if(count($turnos) > 0)
                        <div class="text-muted">
                            Mostrando <span class="font-weight-bold">1</span> a <span class="font-weight-bold">{{ count($turnos) }}</span> de <span class="font-weight-bold">{{ count($turnos) }}</span> registros
                        </div>
                    @endif
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
        .card {
            border: none;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        }
        .empty-state {
            padding: 3rem;
            text-align: center;
        }
        .badge {
            padding: 0.35em 0.65em;
            font-weight: 500;
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
        .table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
    </style>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
