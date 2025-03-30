@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Asignar Puestos a Empleados</h2>

    <form action="{{ route('adminn.asignar.puestos.assign') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="empleado_id">Empleado</label>
        <select name="empleado_id" id="empleado_id" class="form-control">
            @foreach($empleados as $empleado)
                <option value="{{ $empleado->ID_empleado }}">{{ $empleado->nombre }} {{ $empleado->apellido_paterno }} {{ $empleado->apellido_materno }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="puesto_id">Puesto</label>
        <select name="puesto_id" id="puesto_id" class="form-control">
            @foreach($puestos as $puesto)
                <option value="{{ $puesto->id_puesto }}">{{ $puesto->nombre_puesto }}</option>
            @endforeach
        </select>

    </div>

    <button type="submit" class="btn btn-success">Asignar Puesto</button>
</form>
</div>
@endsection
