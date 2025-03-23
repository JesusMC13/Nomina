@extends('layouts.app')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-gray-900 text-white">
    <!-- Imagen de fondo -->
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ 'https://www.jibble.io/wp-content/uploads/2023/08/pexels-ketut-subiyanto-4350059.jpg.webp' }}');"></div>


    <div class="relative z-10 max-w-4xl text-center p-6 bg-black bg-opacity-60 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-4">Sistema de Nómina para Restaurantes</h1>
        <p class="text-lg mb-4">
            Administra turnos, pagos y reportes de manera eficiente. Automatiza cálculos de nómina, gestiona horarios y optimiza la administración del personal.
        </p>
    </div>
</div>
@endsection
