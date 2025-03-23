@extends('layouts.app')

@section('content')
    <h2>Días de Descanso</h2>
    <a href="{{ route('adminn.dias_descanso.create') }}" class="btn btn-primary">Crear Día de Descanso</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diasDescanso as $diaDescanso)
                <tr>
                    <td>{{ $diaDescanso->ID_dia_descanso }}</td>
                    <td>{{ $diaDescanso->Nombre_Dia }}</td>
                    <td>
                        <a href="{{ route('adminn.dias_descanso.show', $diaDescanso) }}" class="btn btn-info">Detalles</a>
                        <a href="{{ route('adminn.dias_descanso.edit', $diaDescanso) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('adminn.dias_descanso.destroy', $diaDescanso) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este día de descanso?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
