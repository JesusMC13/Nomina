@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="h3 mb-4 text-gray-800 text-center">Modificar Turno para {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('adminn.modificar.turnos') }}" class="btn btn-primary">Regresar</a>

    <div class="card shadow mt-4">
        <div class="card-header bg-warning text-white">
            <h6 class="m-0 font-weight-bold">Seleccionar Turno</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('adminn.modificar.turno', $empleado->ID_empleado) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="turno_id">Turno</label>
                    <select class="form-control" name="turno_id" id="turno_id" required>
                        @foreach($turnos as $turno)
                            <option value="{{ $turno->ID_turno }}" 
                                @if($empleado->turnos->contains('ID_turno', $turno->ID_turno)) selected @endif>
                                {{ $turno->nombre_turno }} ({{ $turno->hora_entrada }} - {{ $turno->hora_salida }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">Actualizar Turno</button>
            </form>
        </div>
    </div>
</div>
@endsection
