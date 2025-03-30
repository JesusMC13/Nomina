@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Asignar Día de Descanso a un Empleado</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('adminn.asignardiasdescanso.store') }}" method="POST">
                @csrf <!-- Protección CSRF -->

                <div class="mb-3">
                    <label for="empleado_id" class="form-label fw-bold">Empleado</label>
                    <select name="empleado_id" id="empleado_id" class="form-select" required>
                        <option value="" disabled selected>Seleccione un empleado</option>
                        @foreach($empleados as $empleado)
                            <option value="{{ $empleado->ID_empleado }}">
                                {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="dia_descanso_id" class="form-label fw-bold">Día de Descanso</label>
                    <select name="dia_descanso_id" id="dia_descanso_id" class="form-select" required>
                        <option value="" disabled selected>Seleccione un día</option>
                        @foreach($dias as $dia)
                            <option value="{{ $dia->ID_dia_descanso }}">{{ $dia->nombre_dia }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4">Asignar Día de Descanso</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
