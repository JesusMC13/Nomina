@extends('layouts.app')

@section('content')
    <h2>Detalles del Día de Descanso</h2>
    <p><strong>ID:</strong> {{ $diaDescanso->ID_dia_descanso }}</p>
    <p><strong>Nombre:</strong> {{ $diaDescanso->Nombre_Dia }}</p>
    <a href="{{ route('adminn.dias_descanso.index') }}" class="btn btn-secondary">Volver</a>
@endsection
