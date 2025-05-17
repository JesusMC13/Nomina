@extends('layouts.app')

@section('title', 'Inicio - Sistema de Nómina')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 flex flex-col">
        <!-- Barra de navegación mejorada -->
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-calculator text-blue-600 text-3xl mr-3"></i>
                            <span class="text-2xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">NominaResto</span>
                        </div>
                    </div>
                    <div class="md:hidden">
                        <button class="text-gray-500 hover:text-blue-600 focus:outline-none">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section mejorada -->
        <div class="relative py-16 sm:py-24 lg:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Simplifica la gestión de nóminas</span>
                        <span class="block text-blue-600 bg-clip-text bg-gradient-to-r from-blue-500 to-blue-700">en tu restaurante</span>
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl text-gray-600">
                        Automatiza procesos, reduce errores y ahorra hasta <span class="font-bold text-blue-600">40% de tiempo</span> en la gestión laboral de tu equipo.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('login.index') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg shadow-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 transition-all transform hover:scale-105">
                            <i class="fas fa-sign-in-alt mr-3"></i> Iniciar Sesión
                        </a>
                        <a href="{{ route('register.index') }}" class="inline-flex items-center px-8 py-4 border-2 border-blue-600 text-lg font-bold rounded-lg shadow-md text-blue-700 bg-white hover:bg-blue-50 transition-all transform hover:scale-105">
                            <i class="fas fa-user-plus mr-3"></i> Registrarse Gratis
                        </a>
                    </div>
                    <div class="mt-8 flex justify-center">
                        <div class="inline-flex items-center bg-blue-50 rounded-full px-4 py-2 text-sm font-medium text-blue-700">
                            <i class="fas fa-star text-yellow-400 mr-2"></i> 4.9/5 - Confiado por más de 500 restaurantes
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div id="features" class="py-16 bg-gradient-to-b from-white to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">¿Por qué elegirnos?</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Diseñado específicamente para la industria gastronómica
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Benefit 1 -->
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="text-blue-600 text-4xl mb-4">
                            <i class="fas fa-stopwatch"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Ahorra tiempo</h3>
                        <p class="text-gray-600">
                            Reduce el tiempo de gestión de nóminas de horas a minutos con nuestro sistema automatizado.
                        </p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="text-blue-600 text-4xl mb-4">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Cumplimiento legal</h3>
                        <p class="text-gray-600">
                            Actualizaciones automáticas con los últimos cambios en legislación laboral para tu tranquilidad.
                        </p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="text-blue-600 text-4xl mb-4">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Acceso móvil</h3>
                        <p class="text-gray-600">
                            Gestiona tu equipo desde cualquier lugar con nuestra aplicación móvil optimizada.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section mejorada -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center mb-16">
                    <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Características</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Todo lo que necesitas en un solo lugar
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                    <!-- Feature 1 -->
                    <div class="bg-gray-50 rounded-xl p-8 transition-all hover:transform hover:-translate-y-2 hover:shadow-lg">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Gestión de Turnos Inteligente</h3>
                        <p class="text-gray-600">
                            Organiza y controla los horarios de tu personal fácilmente con nuestro sistema intuitivo que previene conflictos de horarios.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gray-50 rounded-xl p-8 transition-all hover:transform hover:-translate-y-2 hover:shadow-lg">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Cálculo Automático</h3>
                        <p class="text-gray-600">
                            Genera nóminas precisas con descuentos, bonificaciones, horas extras y cálculos automáticos según la legislación vigente.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-gray-50 rounded-xl p-8 transition-all hover:transform hover:-translate-y-2 hover:shadow-lg">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Reportes Detallados</h3>
                        <p class="text-gray-600">
                            Analiza costos laborales y productividad de tu equipo con reportes personalizables y exportables en múltiples formatos.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-gray-50 rounded-xl p-8 transition-all hover:transform hover:-translate-y-2 hover:shadow-lg">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Control de Asistencia</h3>
                        <p class="text-gray-600">
                            Integración con sistemas de huella digital o reconocimiento facial para un registro preciso de asistencia.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-gray-50 rounded-xl p-8 transition-all hover:transform hover:-translate-y-2 hover:shadow-lg">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Alertas Automáticas</h3>
                        <p class="text-gray-600">
                            Recibe notificaciones sobre cambios importantes, cumpleaños del personal y vencimiento de documentos.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-gray-50 rounded-xl p-8 transition-all hover:transform hover:-translate-y-2 hover:shadow-lg">
                        <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Backup en la Nube</h3>
                        <p class="text-gray-600">
                            Tus datos siempre seguros con copias de respaldo automáticas y encriptación de última generación.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div id="testimonials" class="py-16 bg-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Testimonios</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Lo que dicen nuestros clientes
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="flex items-center mb-4">
                            <img class="w-12 h-12 rounded-full mr-4" src="https://randomuser.me/api/portraits/women/32.jpg" alt="Cliente satisfecho">
                            <div>
                                <h4 class="font-bold text-gray-900">María González</h4>
                                <p class="text-blue-600">Dueña - Restaurante "La Parrilla"</p>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">
                            "Desde que implementamos NominaResto, hemos reducido los errores en nómina a cero y ahorramos más de 15 horas al mes en gestión."
                        </p>
                        <div class="mt-4 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="flex items-center mb-4">
                            <img class="w-12 h-12 rounded-full mr-4" src="https://randomuser.me/api/portraits/men/45.jpg" alt="Cliente satisfecho">
                            <div>
                                <h4 class="font-bold text-gray-900">Carlos Mendoza</h4>
                                <p class="text-blue-600">Gerente - Cadena "Sabores Urbanos"</p>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">
                            "La integración con nuestro sistema de punto de venta fue impecable. Ahora tenemos visibilidad completa de nuestros costos laborales en tiempo real."
                        </p>
                        <div class="mt-4 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="flex items-center mb-4">
                            <img class="w-12 h-12 rounded-full mr-4" src="https://randomuser.me/api/portraits/women/68.jpg" alt="Cliente satisfecho">
                            <div>
                                <h4 class="font-bold text-gray-900">Laura Jiménez</h4>
                                <p class="text-blue-600">HR - Grupo Gastronómico "Delicias"</p>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">
                            "El soporte técnico es excepcional. Nos ayudaron a configurar todo y responden nuestras consultas en menos de una hora."
                        </p>
                        <div class="mt-4 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Section -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Planes</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Precios simples para cada negocio
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <!-- Plan Básico -->
                    <div class="bg-gray-50 rounded-xl p-8 border-2 border-gray-200 hover:border-blue-500 transition-all">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Básico</h3>
                        <p class="text-gray-600 mb-6">Perfecto para pequeños restaurantes</p>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-gray-900">$29</span>
                            <span class="text-gray-600">/mes</span>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Hasta 10 empleados
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Gestión de turnos
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Cálculo de nómina
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-times text-red-400 mr-2"></i> Reportes avanzados
                            </li>
                        </ul>
                        <a href="{{ route('register.index') }}" class="block w-full py-3 px-6 text-center bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition-colors">
                            Empezar
                        </a>
                    </div>

                    <!-- Plan Profesional (Destacado) -->
                    <div class="bg-white rounded-xl p-8 border-2 border-blue-500 shadow-lg relative">
                        <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg rounded-tr-lg">
                            POPULAR
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Profesional</h3>
                        <p class="text-gray-600 mb-6">Para restaurantes medianos</p>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-gray-900">$79</span>
                            <span class="text-gray-600">/mes</span>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Hasta 30 empleados
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Gestión de turnos
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Cálculo de nómina
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Reportes avanzados
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Soporte prioritario
                            </li>
                        </ul>
                        <a href="{{ route('register.index') }}" class="block w-full py-3 px-6 text-center bg-blue-600 border border-blue-600 rounded-lg text-white font-medium hover:bg-blue-700 transition-colors">
                            Empezar
                        </a>
                    </div>

                    <!-- Plan Empresarial -->
                    <div class="bg-gray-50 rounded-xl p-8 border-2 border-gray-200 hover:border-blue-500 transition-all">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Empresarial</h3>
                        <p class="text-gray-600 mb-6">Para cadenas de restaurantes</p>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-gray-900">$199</span>
                            <span class="text-gray-600">/mes</span>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Empleados ilimitados
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Multi-sucursal
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Todos los features
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> Entrenamiento personalizado
                            </li>
                        </ul>
                        <a href="{{ route('register.index') }}" class="block w-full py-3 px-6 text-center bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition-colors">
                            Empezar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section mejorada -->
        <div class="bg-gradient-to-r from-blue-700 to-blue-900">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <div class="lg:w-2/3">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        <span class="block">¿Listo para transformar tu gestión de nómina?</span>
                        <span class="block text-blue-200">Regístrate hoy y obtén 14 días gratis.</span>
                    </h2>
                    <p class="mt-4 text-lg text-blue-100">
                        Sin tarjeta de crédito requerida. Cancela en cualquier momento.
                    </p>
                </div>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-lg shadow">
                        <a href="{{ route('register.index') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg text-blue-700 bg-white hover:bg-blue-50 transition-all transform hover:scale-105">
                            <i class="fas fa-rocket mr-3"></i> Comenzar ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer mejorado -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
                    <div>
                        <h3 class="text-lg font-bold mb-4">NominaResto</h3>
                        <p class="text-gray-400">
                            La solución todo-en-uno para la gestión de nómina en la industria gastronómica.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Producto</h4>
                        <ul class="space-y-3">
                            <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Características</a></li>
                            <li><a href="#testimonials" class="text-gray-400 hover:text-white transition-colors">Testimonios</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Precios</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Recursos</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Documentación</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Soporte</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Contacto</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-envelope mr-3"></i> hola@nominaresto.com
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-phone-alt mr-3"></i> +1 (555) 123-4567
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-map-marker-alt mr-3"></i> Ciudad de México
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-16 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        &copy; 2024 NominaResto. Todos los derechos reservados.
                    </p>
                    <div class="mt-4 md:mt-0 flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <style>
        /* Animaciones mejoradas */
        .transition-all {
            transition: all 0.3s ease;
        }

        .hover\:scale-105:hover {
            transform: scale(1.05);
        }

        .hover\:-translate-y-2:hover {
            transform: translateY(-0.5rem);
        }

        /* Efecto de gradiente animado */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .gradient-animate {
            background-size: 200% 200%;
            animation: gradientAnimation 6s ease infinite;
        }
    </style>
@endsection
