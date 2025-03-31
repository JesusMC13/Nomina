@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Asistencia</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleado.asistencias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="fecha">Fecha de Asistencia</label>
            <input type="date" class="form-control" name="fecha" required>
        </div>
        <div class="form-group">
            <label for="hora_inicio">Hora de Entrada</label>
            <input type="text" class="form-control" name="hora_inicio" id="hora_inicio" placeholder="hh:mm AM/PM" required>
        </div>
        <div class="form-group">
            <label for="hora_fin">Hora de Salida</label>
            <input type="text" class="form-control" name="hora_fin" id="hora_fin" placeholder="hh:mm AM/PM" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
    </form>
</div>

<!-- Incluir Flatpickr para el TimePicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#hora_inicio, #hora_fin", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K", // Formato de 12 horas con AM/PM
            time_24hr: false,    // Asegúrate de que sea en formato 12 horas
        });
    });
</script>
@endsection
