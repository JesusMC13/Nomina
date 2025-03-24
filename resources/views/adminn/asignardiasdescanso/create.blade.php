@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Asignar Días de Descanso</h2>

    <form action="{{ route('adminn.asignardiasdescanso.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="empleado_id" class="form-label">Empleado</label>
            <select name="empleado_id" id="empleado_id" class="form-control" required>
                <option value="">Seleccione un empleado</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->ID_empleado }}">{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Días de Descanso</label><br>
            @foreach($dias as $dia)
                <input type="checkbox" name="dias_descanso[]" value="{{ $dia->ID_dia_descanso }}"> {{ $dia->nombre_dia }} <br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Asignar</button>
    </form>
</div>
@endsection
