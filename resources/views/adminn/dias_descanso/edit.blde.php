@extends('layouts.app')

@section('content')
    <h2>Editar Día de Descanso</h2>
    <form action="{{ route('adminn.dias_descanso.update', $diaDescanso) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Nombre_Dia">Nombre del Día</label>
            <input type="text" name="Nombre_Dia" id="Nombre_Dia" class="form-control" value="{{ $diaDescanso->Nombre_Dia }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
