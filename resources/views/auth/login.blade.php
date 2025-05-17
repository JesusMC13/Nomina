@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600">
        <div class="w-full max-w-md mx-4">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-500 hover:scale-105">
                <!-- Header con gradiente -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-6 px-8">
                    <h1 class="text-3xl font-bold text-center text-white">Bienvenido</h1>
                    <p class="text-blue-100 text-center mt-1">Ingresa tus credenciales</p>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
                        @csrf

                        <!-- Input Email con efecto -->
                        <div class="relative">
                            <input type="email" id="email" name="email"
                                   class="peer h-12 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-indigo-600"
                                   placeholder="Email" required>
                            <label for="email"
                                   class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                Correo Electrónico
                            </label>
                            <div class="mt-1 h-0.5 bg-indigo-100 scale-x-0 peer-focus:scale-x-100 transition-transform origin-left"></div>
                        </div>

                        <!-- Input Password con efecto -->
                        <div class="relative mt-8">
                            <input type="password" id="password" name="password"
                                   class="peer h-12 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-indigo-600"
                                   placeholder="Password" required>
                            <label for="password"
                                   class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                Contraseña
                            </label>
                            <div class="mt-1 h-0.5 bg-indigo-100 scale-x-0 peer-focus:scale-x-100 transition-transform origin-left"></div>
                        </div>

                        <!-- Mensaje de error -->
                        @if($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 animate-shake">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">* {{ $errors->first() }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Botón de Login con efecto -->
                        <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg transform transition hover:scale-105">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <svg class="h-5 w-5 text-indigo-300 group-hover:text-indigo-200 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
              </svg>
            </span>
                            Ingresar
                        </button>

                        <!-- Botón de Salir mejorado -->
                        <a href="{{ url('/') }}"
                           class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all hover:shadow-md">
                            <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Salir
                        </a>
                    </form>
                </div>

                <!-- Footer del card -->
                <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                    <div class="flex justify-center text-sm text-gray-600">
                        <a href="#" class="text-indigo-600 hover:text-indigo-500 mr-4">¿Olvidaste tu contraseña?</a>
                        <a href="#" class="text-indigo-600 hover:text-indigo-500">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    </style>
@endsection
