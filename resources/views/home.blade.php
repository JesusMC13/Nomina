@extends('layouts.app')

@section('title', 'Inicio - Sistema de Nómina')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 flex flex-col">
        <!-- Barra de navegación -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-calculator text-blue-600 text-2xl mr-2"></i>
                            <span class="text-xl font-semibold text-gray-900">NominaResto</span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Sistema de Nómina</span>
                        <span class="block text-blue-600">para Restaurantes</span>
                    </h1>
                    <p class="mt-6 max-w-lg mx-auto text-lg text-gray-600">
                        La solución todo-en-uno para <span class="font-medium text-blue-600">gestionar nóminas</span>,
                        <span class="font-medium text-blue-600">controlar horarios</span> y
                        <span class="font-medium text-blue-600">optimizar costos laborales</span> en tu restaurante.
                    </p>
                    <div class="mt-10 flex justify-center space-x-4">
                        <a href="{{ route('login.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors">
                            Registrarse
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Características</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Todo lo que necesitas en un solo lugar
                    </p>
                </div>

                <div class="mt-16">
                    <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="pt-6">
                            <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                                <div class="-mt-6">
                                    <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-blue-500 rounded-md shadow-lg">
                                        <i class="fas fa-clock text-white text-xl"></i>
                                    </span>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Gestión de Turnos</h3>
                                    <p class="mt-5 text-base text-gray-600">
                                        Organiza y controla los horarios de tu personal fácilmente con nuestro sistema intuitivo.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="pt-6">
                            <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                                <div class="-mt-6">
                                    <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-blue-500 rounded-md shadow-lg">
                                        <i class="fas fa-file-invoice-dollar text-white text-xl"></i>
                                    </span>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Cálculo Automático</h3>
                                    <p class="mt-5 text-base text-gray-600">
                                        Genera nóminas precisas con descuentos, bonificaciones y cálculos automáticos.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="pt-6">
                            <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                                <div class="-mt-6">
                                    <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-blue-500 rounded-md shadow-lg">
                                        <i class="fas fa-chart-line text-white text-xl"></i>
                                    </span>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Reportes Detallados</h3>
                                    <p class="mt-5 text-base text-gray-600">
                                        Analiza costos laborales y productividad de tu equipo con reportes personalizables.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-blue-700">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    <span class="block">¿Listo para comenzar?</span>
                    <span class="block text-blue-200">Regístrate hoy y simplifica tu nómina.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a href="{{ route('register.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition-colors">
                            Comenzar ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-base text-gray-500">
                    &copy; 2024 NominaResto. Todos los derechos reservados.
                </p>
            </div>
        </footer>
    </div>

    <style>
        /* Animaciones sutiles */
        .transition-colors {
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
            transition: all 0.2s ease;
        }
    </style>
@endsection
