@extends('layouts.app')

@section('content')
    <h1>Editar Día de Descanso</h1>
    <form action="{{ route('adminn.dias_descanso.update', $diaDescanso->ID_dia_descanso) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre_dia">Nombre del Día:</label>
            <input type="text" name="nombre_dia" value="{{ old('nombre_dia', $diaDescanso->nombre_dia) }}">
        </div>

        <button type="submit">Guardar cambios</button>
    </form>
@endsection
