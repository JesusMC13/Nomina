<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrador - Dashboard</title>
    <link href="{{ asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --azul-oscuro: #1a3e72;
            --azul-medio: #2a5a9a;
            --azul-claro: #3a76c2;
            --azul-hover: #4d8fd8;
            --texto-claro: #f8f9fa;
        }

        body {
            background-color: #f5f7fa;
        }

        /* Sidebar Azul */
        .sidebar {
            background: linear-gradient(180deg, var(--azul-oscuro) 0%, var(--azul-medio) 100%);
        }

        .sidebar-brand {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand-icon {
            color: var(--texto-claro);
        }

        .sidebar-brand-text {
            color: var(--texto-claro);
        }

        .nav-item {
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }

        .nav-link i {
            color: rgba(255, 255, 255, 0.6);
        }

        .nav-item:hover .nav-link,
        .nav-item:hover .nav-link i {
            color: var(--texto-claro);
        }

        /* Topbar Azul */
        .topbar {
            background: linear-gradient(90deg, var(--azul-medio) 0%, var(--azul-claro) 100%);
        }

        .topbar .nav-link {
            color: var(--texto-claro) !important;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background-color: var(--azul-medio);
            border: none;
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
        }

        .dropdown-item:hover {
            background-color: var(--azul-hover);
            color: var(--texto-claro);
        }

        /* Cards */
        .card {
            border: none;
            border-left: 4px solid var(--azul-claro);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Botones */
        .btn-primary {
            background-color: var(--azul-claro);
            border-color: var(--azul-claro);
        }

        .btn-primary:hover {
            background-color: var(--azul-hover);
            border-color: var(--azul-hover);
        }

        /* User Profile */
        .img-profile {
            border: 2px solid white;
            box-shadow: 0 0 0 2px var(--azul-claro);
        }

        /* Scroll to top */
        .scroll-to-top {
            background-color: var(--azul-claro);
        }

        .scroll-to-top:hover {
            background-color: var(--azul-hover);
        }
    </style>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Administrador</div>
        </a>
        <hr class="sidebar-divider my-0">
        <div class="sidebar-heading">Gestión de Nómina</div>

        <!-- Empleados -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('adminn.empleados.index') }}">
                <i class="fas fa-users"></i>
                <span>Empleados</span>
            </a>
        </li>
        <!-- Gestión de Puestos -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="puestosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-briefcase"></i>
                <span>Gestión de Puestos</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="puestosDropdown">
                <a class="dropdown-item" href="{{ route('adminn.puestos.index') }}">Ver Puestos</a>
                <a class="dropdown-item" href="{{ route('adminn.asignar.puestos') }}">Asignar Puestos a Empleados</a>
                <a class="dropdown-item" href="{{ route('adminn.empleados.puestos') }}">Ver Puestos de los Empleados</a>
            </div>
        </li>

        <!-- Gestión de Turnos y Horarios -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="turnosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-calendar-alt"></i>
                <span>Gestión de Turnos y Horarios</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="turnosDropdown">
                <a class="dropdown-item" href="{{ route('adminn.turnos.index') }}">Ver Turnos</a>
                <a class="dropdown-item" href="{{ route('adminn.horarios.index') }}">Ver Horarios de acuerdo a turnos</a>
                <a class="dropdown-item" href="{{ route('adminn.asignar.turnos') }}">Asignar Turnos a Empleados</a>
            </div>
        </li>

        <!-- Gestión de Días de Descanso -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="diasDescansoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-calendar-alt"></i>
                <span>Gestión de Días de Descanso</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="diasDescansoDropdown">
                <a class="dropdown-item" href="{{ route('adminn.asignardiasdescanso.index') }}">Asignar días de descanso semanales a cada empleado.</a>
            </div>
        </li>

        <!-- Registro de Asistencias -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="asistenciasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-users"></i>
                <span>Registro de Asistencias</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="asistenciasDropdown">
                <a class="dropdown-item" href="{{ route('adminn.asistencias.index') }}">Consultar Asistencias</a>
                <a class="dropdown-item" href="{{ route('adminn.retardos.index') }}">Ver Retardos de los empleados</a>
            </div>
        </li>

        <!-- Gestión de Justificaciones -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('adminn.justificaciones.index') }}">
                <i class="fas fa-file-alt"></i>
                <span>Gestión de Justificaciones</span>
            </a>
        </li>

        <!-- Gestión de Descuentos -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('adminn.aplicardescuento.index') }}">
                <i class="fas fa-percentage"></i>
                <span>Gestión de Descuentos</span>
            </a>
        </li>

        <!-- Reportes -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Reportes</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="reportesDropdown">
                <a class="dropdown-item" href="{{ route('adminn.reportes.index') }}">Generar Reporte</a>
                <a class="dropdown-item" href="http://127.0.0.1:8000/adminn/reportes/ver">Ver Reportes</a>
            </div>
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
                            <span class="mr-2 d-none d-lg-inline text-white small">Uriel Estrada Mateo</span>
                            <img class="img-profile rounded-circle" src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_400,h_400/https:/appsdejoseluis.com/wp-content/uploads/2020/04/face_co.png">
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Cerrar sesión
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Panel de Control</h1>

                <!-- Content Row -->
                <div class="row">
                    <!-- Empleados Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Empleados Activos</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">42</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Asistencias Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Asistencia Hoy</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">92%</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Retardos Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Retardos Hoy</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reportes Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Reportes Generados</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">15</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
