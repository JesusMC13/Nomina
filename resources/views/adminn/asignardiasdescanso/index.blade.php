@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Asignación de Días de Descanso</h2>
    <div class="d-flex justify-content-between mb-3">
    <a href="{{ route('adminn.asignardiasdescanso.create') }}" class="btn btn-primary mb-3">Asignar Dia de descanso al empleado</a>
    <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Días de Descanso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}</td>
                    <td>{{ implode(', ', $empleado->diasDescanso->pluck('nombre_dia')->toArray()) }}</td>
                    <td>
                        <a href="{{ route('adminn.asignardiasdescanso.edit', $empleado->ID_empleado) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('adminn.asignardiasdescanso.destroy', $empleado->ID_empleado) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
