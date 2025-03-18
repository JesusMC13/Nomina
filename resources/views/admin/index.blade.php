@extends('layouts.app') {{-- Aquí extiende el layout principal --}}

@section('title', 'Panel de Administrador')

@section('content')
<div class="w-3/4 mx-auto my-12 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h1 class="text-3xl text-center font-bold text-indigo-700">Puestos</h1>
    
    <div class="mt-8 flex justify-center space-x-4">
        <a href="#" class="px-6 py-3 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600">
            Crear Puestos
        </a>
       
    </div>
</div>
<div class="w-3/4 mx-auto my-12 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h1 class="text-3xl text-center font-bold text-indigo-700"></h1>
    
    <div class="mt-8 flex justify-center space-x-4">
        <a href="#" class="px-6 py-3 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600">
            Turnos
        </a>
        <a href="#" class="px-6 py-3 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">
            Craer Turnos
        </a>
    </div>
</div>
@endsection
