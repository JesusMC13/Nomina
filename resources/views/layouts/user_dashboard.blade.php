a<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Empleado - Dashboard</title>
    <link href="{{ asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('empleado.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-user"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Empleado</div>
            </a>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading">Acciones del Usuario</div>

            <!-- Consulta de Turnos y Horarios -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Consulta de Turnos y Horarios</span>
                </a>
            </li>

            <!-- Consulta de Días de Descanso -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-bed"></i>
                    <span>Consulta de Días de Descanso</span>
                </a>
            </li>

            <!-- Registro Personal -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-clock"></i>
                    <span>Registro Personal</span>
                </a>
            </li>

            <!-- Solicitudes de Justificación -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-envelope"></i>
                    <span>Solicitudes de Justificación</span>
                </a>
            </li>

            <!-- Consulta de Nómina -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Consulta de Nómina</span>
                </a>
            </li>

            <!-- Historial Personal -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-history"></i>
                    <span>Historial Personal</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                                 <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>

                                <!-- Aquí se verifica el género para mostrar el avatar adecuado -->
                                @if(auth()->user()->gender == 'mujer')
                                    <img class="img-profile rounded-circle" src="https://i.pinimg.com/474x/6d/5e/38/6d5e38d19bf4c0c9554b1e6beab75952.jpg">
                                @else
                                    <img class="img-profile rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKYRbTui6o8jHIqLFc3hpN-4ItYVRSV5j-8hSTTKLzjVg1tHWTa2__5bmp25TA56gFXhQ&usqp=CAU">
                                @endif
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Panel de Control</h1>
                    <!-- Aquí pueden ir las notificaciones o alertas específicas del empleado -->
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('theme/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
