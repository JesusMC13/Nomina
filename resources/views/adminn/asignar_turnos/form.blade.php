@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Asignar Turno a: {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}
            </h1>
            <a href="{{ route('adminn.asignar.turnos') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-warning">
                <h6 class="m-0 font-weight-bold text-white">Seleccionar Turno</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('adminn.asignar.turnos.update', $empleado->ID_empleado) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="turno_id" class="col-md-3 col-form-label">Turno Actual:</label>
                        <div class="col-md-9">
                            <p class="form-control-plaintext">
                                @if($empleado->turno)
                                    {{ $empleado->turno->nombre_turno }}
                                    ({{ $empleado->turno->hora_entrada }} - {{ $empleado->turno->hora_salida }})
                                @else
                                    <span class="text-danger">No tiene turno asignado</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="turno_id" class="col-md-3 col-form-label">Nuevo Turno:</label>
                        <div class="col-md-9">
                            <select name="turno_id" id="turno_id" class="form-control" required>
                                <option value="">Seleccione un turno</option>
                                @foreach($turnos as $turno)
                                    <option value="{{ $turno->ID_turno }}"
                                        {{ $empleado->turno_id == $turno->ID_turno ? 'selected' : '' }}>
                                        {{ $turno->nombre_turno }} ({{ $turno->hora_entrada }} - {{ $turno->hora_salida }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
