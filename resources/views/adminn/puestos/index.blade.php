@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Gestionar Puestos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Puestos</h6>
        </div>
        <div class="card-body">
            <!-- Contenedor para los botones -->
            <div class="mb-3">
                <a href="{{ route('adminn.puestos.create') }}" class="btn btn-success mr-2">Agregar Puesto</a>
                <a href="{{ route('admin.index') }}" class="btn btn-primary">Regresar al Dashboard</a>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Puesto</th>
                        <th>Salario Base</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($puestos as $puesto)
                    <tr>
                        <td>{{ $puesto->nombre_puesto }}</td>
                        <td>${{ number_format($puesto->salario_base, 2) }}</td>
                        <td>
                            <a href="{{ route('adminn.puestos.edit', $puesto->id_puesto) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('adminn.puestos.destroy', $puesto->id_puesto) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
