@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><i class="fas fa-file-invoice-dollar mr-2"></i> Sistema de Reportes de Nómina</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-plus-circle fa-4x text-primary mb-3"></i>
                                <h4>Generar Nuevo Reporte</h4>
                                <p class="text-muted">Genere un nuevo reporte de nómina para el periodo actual</p>
                                <a href="{{ route('adminn.reportes.generar') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-file-alt mr-2"></i> Generar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-list-alt fa-4x text-info mb-3"></i>
                                <h4>Reportes Anteriores</h4>
                                <p class="text-muted">Consulte los reportes de nómina generados anteriormente</p>
                                <a href="{{ route('adminn.reportes.ver') }}" class="btn btn-info btn-lg">
                                    <i class="fas fa-history mr-2"></i> Ver Historial
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
