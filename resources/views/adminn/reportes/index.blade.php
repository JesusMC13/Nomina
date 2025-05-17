@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-file-invoice-dollar mr-2"></i>Sistema de Reportes de Nómina
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('admin.index') }}" class="text-white-50">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Reportes</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Tarjetas de opciones -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-tasks mr-2"></i>Opciones de Reportes
                </h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Generar Reporte -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-left-primary h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center p-3">
                                    <div class="icon-circle bg-primary-soft mb-4">
                                        <i class="fas fa-file-alt fa-3x text-primary"></i>
                                    </div>
                                    <h4 class="font-weight-bold text-primary mb-3">Generar Nuevo Reporte</h4>
                                    <p class="text-muted mb-4">Genere un nuevo reporte de nómina con los datos más recientes para el periodo actual.</p>
                                    <a href="{{ route('adminn.reportes.generar') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                                        <i class="fas fa-plus-circle mr-2"></i> Crear Reporte
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historial de Reportes -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-left-info h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center p-3">
                                    <div class="icon-circle bg-info-soft mb-4">
                                        <i class="fas fa-history fa-3x text-info"></i>
                                    </div>
                                    <h4 class="font-weight-bold text-info mb-3">Historial de Reportes</h4>
                                    <p class="text-muted mb-4">Consulte y descargue los reportes de nómina generados en periodos anteriores.</p>
                                    <a href="{{ route('adminn.reportes.ver') }}" class="btn btn-info rounded-pill px-4 py-2 shadow-sm">
                                        <i class="fas fa-list-alt mr-2"></i> Ver Historial
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos CSS Personalizados -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }
        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bg-primary-soft {
            background-color: rgba(78, 115, 223, 0.15);
        }
        .bg-info-soft {
            background-color: rgba(54, 185, 204, 0.15);
        }
        .card {
            border-radius: 0.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .rounded-pill {
            border-radius: 50rem !important;
        }
    </style>

    <!-- Script para efectos -->
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Efecto hover para las tarjetas
                $('.card').hover(
                    function() {
                        $(this).addClass('shadow-lg');
                    },
                    function() {
                        $(this).removeClass('shadow-lg');
                    }
                );
            });
        </script>
    @endsection
@endsection
