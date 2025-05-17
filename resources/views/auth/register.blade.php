@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-lg">
                <!-- Encabezado con gradiente azul -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-8 px-6 text-center">
                    <h1 class="text-3xl font-bold text-white">Registro</h1>
                    <p class="text-blue-100 mt-2">Crea tu cuenta en pocos pasos</p>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
                        @csrf

                        <!-- Grupo de Campos de Formulario -->
                        <div class="space-y-5">
                            <!-- Nombre -->
                            <div class="relative">
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                       class="peer h-12 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-600"
                                       placeholder="Nombre" required>
                                <label for="nombre"
                                       class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-blue-600 peer-focus:text-sm">
                                    Nombre
                                </label>
                                <div class="mt-1 h-0.5 bg-blue-100 scale-x-0 peer-focus:scale-x-100 transition-transform origin-left"></div>
                                @error('nombre')
                                <p class="mt-1 text-sm text-red-600 flex items-center animate-pulse">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Apellido Paterno -->
                            <div class="relative">
                                <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                                       class="peer h-12 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-600"
                                       placeholder="Apellido Paterno" required>
                                <label for="apellido_paterno"
                                       class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-blue-600 peer-focus:text-sm">
                                    Apellido Paterno
                                </label>
                                <div class="mt-1 h-0.5 bg-blue-100 scale-x-0 peer-focus:scale-x-100 transition-transform origin-left"></div>
                                @error('apellido_paterno')
                                <p class="mt-1 text-sm text-red-600 flex items-center animate-pulse">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Apellido Materno -->
                            <div class="relative">
                                <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}"
                                       class="peer h-12 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-600"
                                       placeholder="Apellido Materno">
                                <label for="apellido_materno"
                                       class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-blue-600 peer-focus:text-sm">
                                    Apellido Materno
                                </label>
                                <div class="mt-1 h-0.5 bg-blue-100 scale-x-0 peer-focus:scale-x-100 transition-transform origin-left"></div>
                                @error('apellido_materno')
                                <p class="mt-1 text-sm text-red-600 flex items-center animate-pulse">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="relative">
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                       class="peer h-12 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-600"
                                       placeholder="Email" required>
                                <label for="email"
                                       class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-blue-600 peer-focus:text-sm">
                                    Correo Electrónico
                                </label>
                                <div class="mt-1 h-0.5 bg-blue-100 scale-x-0 peer-focus:scale-x-100 transition-transform origin-left"></div>
                                @error('email')
                                <p class="mt-1 text-sm text-red-600 flex items-center animate-pulse">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                       class="peer h-12 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-600"
                                       placeholder="Password" required>
                                <label for="password"
                                       class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-blue-600 peer-focus:text-sm">
                                    Contraseña
                                </label>
                                <div class="mt-1 h-0.5 bg-blue-100 scale-x-0 peer-focus:scale-x-100 transition-transform origin-left"></div>
                                @error('password')
                                <p class="mt-1 text-sm text-red-600 flex items-center animate-pulse">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="peer h-12 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-blue-600"
                                       placeholder="Confirm Password" required>
                                <label for="password_confirmation"
                                       class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-blue-600 peer-focus:text-sm">
                                    Confirmar Contraseña
                                </label>
                                <div class="mt-1 h-0.5 bg-blue-100 scale-x-0 peer-focus:scale-x-100 transition-transform origin-left"></div>
                                @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-600 flex items-center animate-pulse">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-col space-y-4 pt-4">
                            <button type="submit"
                                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg transform transition hover:scale-[1.02]">
              <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
              </span>
                                Registrar
                            </button>

                            <a href="{{ url('/') }}"
                               class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-lg font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-md">
                                <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Salir
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Footer -->

            </div>
        </div>
    </div>

    <style>
        /* Animación para errores */
        .animate-pulse {
            animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
@endsection
