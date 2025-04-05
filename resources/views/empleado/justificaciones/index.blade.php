@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('empleado.dashboard') }}" class="btn btn-sm btn-light mr-2">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h5 class="mb-0 d-inline-block">
                                <i class="fas fa-file-alt mr-2"></i>Mis Justificaciones
                            </h5>
                        </div>
                        <button class="btn btn-sm btn-light" data-toggle="collapse" data-target="#formJustificacion">
                            <i class="fas fa-plus mr-1"></i>Nueva
                        </button>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Formulario Colapsable -->
                        <div class="collapse mb-4 @if($errors->any()) show @endif" id="formJustificacion">
                            <div class="card card-body">
                                <form method="POST" action="{{ route('empleado.justificaciones.index') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="fecha">Fecha *</label>
                                        <input type="date" class="form-control @error('fecha') is-invalid @enderror"
                                               id="fecha" name="fecha" required max="{{ date('Y-m-d') }}"
                                               value="{{ old('fecha') }}">
                                        @error('fecha')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="motivo">Motivo *</label>
                                        <textarea class="form-control @error('motivo') is-invalid @enderror"
                                                  id="motivo" name="motivo" rows="3" required
                                                  placeholder="Describe el motivo de tu justificación">{{ old('motivo') }}</textarea>
                                        @error('motivo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane mr-1"></i>Enviar
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary"
                                                data-toggle="collapse" data-target="#formJustificacion">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Listado de Justificaciones -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Motivo</th>
                                    <th>Estado</th>
                                    <th>Registro</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($justificaciones as $justificacion)
                                    <tr>
                                        <td>{{ $justificacion->fecha->format('d/m/Y') }}</td>
                                        <td>{{ Str::limit($justificacion->motivo, 80) }}</td>
                                        <td>
                                    <span class="badge
                                        @if($justificacion->estado->nombre_estado == 'Aprobado') badge-success
                                        @elseif($justificacion->estado->nombre_estado == 'Rechazado') badge-danger
                                        @else badge-warning @endif">
                                        {{ $justificacion->estado->nombre_estado }}
                                    </span>
                                        </td>
                                        <td>{{ $justificacion->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No hay justificaciones registradas</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        {{ $justificaciones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Mostrar formulario si hay errores
        @if($errors->any())
        $(document).ready(function() {
            $('#formJustificacion').collapse('show');
        });
        @endif
    </script>
@endsection
