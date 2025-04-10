@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-list-alt mr-2"></i> Reportes de Nómina</h3>
                    <div>
                        <a href="{{ route('adminn.reportes.generar') }}" class="btn btn-light mr-2">
                            <i class="fas fa-plus mr-2"></i> Nuevo Reporte
                        </a>
                        <a href="{{ route('admin.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Total Nómina</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reportes as $reporte)
                            <tr>
                                <td>{{ $reporte->fecha_reporte->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $detalles = is_array($reporte->detalles) ? $reporte->detalles : json_decode($reporte->detalles, true);
                                        echo $detalles[0]['nombre'] ?? 'N/A';
                                    @endphp
                                </td>
                                <td>${{ number_format($reporte->total_nomina, 2) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- Botón Ver -->
                                        <a href="{{ route('adminn.reportes.show', $reporte->ID_reporte) }}"
                                           class="btn btn-sm btn-info" title="Ver detalle">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Botón Exportar PDF -->
                                        <a href="{{ route('adminn.reportes.exportar-pdf', $reporte->ID_reporte) }}"
                                           class="btn btn-sm btn-danger" title="Exportar a PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>

                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('adminn.reportes.destroy', $reporte->ID_reporte) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-warning"
                                                    title="Eliminar"
                                                    onclick="return confirm('¿Está seguro de eliminar este reporte?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay reportes generados aún</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $reportes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
