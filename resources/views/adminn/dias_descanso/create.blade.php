@extends('layouts.app')  <!-- Extiende el layout del dashboard -->

@section('content')  <!-- Inicia la sección de contenido -->
    <h2>Crear Día de Descanso</h2>

    <form action="{{ route('adminn.dias_descanso.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre_dia" class="form-label">Nombre del Día de Descanso</label>
            <input type="text" name="nombre_dia" id="nombre_dia" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection  <!-- Cierra la sección de contenido -->
