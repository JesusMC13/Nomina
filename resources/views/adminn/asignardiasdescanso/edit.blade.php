@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4 py-3 px-4 bg-gradient-primary text-white rounded-lg">
            <div>
                <h2 class="h3 mb-1 font-weight-bold">
                    <i class="fas fa-calendar-alt mr-2"></i>Editar Días de Descanso
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.empleados.index') }}" class="text-white-50">Empleados</a></li>
                        <li class="breadcrumb-item text-white"><a href="{{ route('adminn.asignardiasdescanso.index') }}" class="text-white-50">Asignación de Descansos</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Editar</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Tarjeta de formulario -->
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden mb-5">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-user-clock mr-2"></i>{{ $empleado->nombre }} {{ $empleado->apellido_paterno }}
                </h6>
                <small class="d-block mt-1">{{ $empleado->puesto->nombre_puesto }}</small>
            </div>

            <div class="card-body">
                <form action="{{ route('adminn.asignardiasdescanso.update', $empleado->ID_empleado) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="font-weight-bold text-primary mb-3">Seleccione los días de descanso:</label>
                        <div class="row">
                            @foreach($dias as $dia)
                                <div class="col-md-4 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="dia_{{ $dia->ID_dia_descanso }}"
                                               name="dias_descanso[]"
                                               value="{{ $dia->ID_dia_descanso }}"
                                               @if($empleado->diasDescanso->contains($dia->ID_dia_descanso)) checked @endif>
                                        <label class="custom-control-label" for="dia_{{ $dia->ID_dia_descanso }}">
                                            <span class="h5">{{ $dia->nombre_dia }}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('adminn.asignardiasdescanso.index') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="fas fa-arrow-left mr-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save mr-2"></i> Actualizar Descansos
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Estilos CSS Personalizados -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .custom-control-input:checked ~ .custom-control-label::before {
            border-color: #4e73df;
            background-color: #4e73df;
        }
        .custom-control-label {
            cursor: pointer;
            padding-left: 5px;
        }
        .custom-checkbox {
            padding-left: 1.5rem;
        }
        .card {
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
    </style>
@endsection
