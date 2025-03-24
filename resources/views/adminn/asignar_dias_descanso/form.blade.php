@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Asignar Días de Descanso a: {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h2>

    <form action="{{ route('adminn.asignar.dias.descanso', ['ID_empleado' => $empleado->ID_empleado]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="dias_descanso">Seleccione los días de descanso:</label>
            <select name="dias_descanso[]" id="dias_descanso" class="form-control" multiple>
                @foreach($diasDescanso as $dia)
                    <option value="{{ $dia }}" {{ in_array($dia, $diasDescansoAsignados ?? []) ? 'selected' : '' }}>
                        {{ $dia }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Asignar Días de Descanso</button>
    </form>
</div>
@endsection
