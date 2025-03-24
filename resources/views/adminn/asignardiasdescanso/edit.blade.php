<!-- resources/views/adminn/asignardiasdescanso/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Días de Descanso para: {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</h2>

    <form action="{{ route('adminn.asignardiasdescanso.update', $empleado->ID_empleado) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Días de Descanso</label><br>
            @foreach($dias as $dia)
                <input type="checkbox" name="dias_descanso[]" value="{{ $dia->ID_dia_descanso }}" 
                    @if($empleado->diasDescanso->contains($dia->ID_dia_descanso)) checked @endif> {{ $dia->nombre_dia }} <br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
