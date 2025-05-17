<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panel de control para empleados">
    <meta name="author" content="NominaApp">
    <title>Empleado - Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('theme/img/favicon.ico') }}">

    <!-- Font Awesome -->
    <link href="{{ asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
        }

        body {
            background-color: #f8f9fc;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .sidebar .nav-item .nav-link {
            transition: all 0.3s;
            position: relative;
        }

        .sidebar .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar .nav-item .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .sidebar .nav-item .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: white;
            opacity: 0;
            transition: all 0.3s;
        }

        .sidebar .nav-item .nav-link:hover::after,
        .sidebar .nav-item .nav-link.active::after {
            opacity: 1;
        }

        .sidebar-brand {
            height: 4.375rem;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand-icon {
            font-size: 1.5rem;
        }

        .sidebar-brand-text {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .topbar {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2);
        }

        .stat-card {
            border-left: 0.25rem solid;
        }

        .stat-card .icon-bg {
            background-color: rgba(0, 0, 0, 0.05);
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
            border-left: 0.25rem solid var(--primary-color) !important;
        }

        .quick-action-btn {
            transition: all 0.3s;
        }

        .quick-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .scroll-to-top {
            background: var(--primary-color);
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: all 0.3s;
        }

        .scroll-to-top:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
        }

        .user-profile-img {
            width: 2.5rem;
            height: 2.5rem;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar .nav-item .nav-link {
                padding: 0.5rem 1rem;
            }
        }
    </style>
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('empleado.dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Mi Espacio Laboral</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('empleado.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestión Laboral
        </div>

        <!-- Nav Item - Horarios -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('empleado.horarios.index') }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Mis Horarios</span>
            </a>
        </li>

        <!-- Nav Item - Descansos -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('empleado.dias-descanso.index') }}">
                <i class="fas fa-bed"></i>
                <span>Días de Descanso</span>
            </a>
        </li>

        <!-- Nav Item - Asistencias -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('empleado.asistencias.index') }}">
                <i class="fas fa-clock"></i>
                <span>Registro Asistencia</span>
            </a>
        </li>

        <!-- Nav Item - Justificaciones -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('empleado.justificaciones.index') }}">
                <i class="fas fa-envelope"></i>
                <span>Justificaciones</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestión Económica
        </div>

        <!-- Nav Item - Descuentos -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('empleado.descuentos.index') }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Descuentos</span>
            </a>
        </li>

        <!-- Nav Item - Nóminas -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('empleado.nominas.index') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Mis Nóminas</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Centro de Notificaciones
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Diciembre 12, 2023</div>
                                    <span class="font-weight-bold">Nueva nómina disponible para descargar</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-calendar-check text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Diciembre 10, 2023</div>
                                    Cambios en tu horario para la próxima semana
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Mostrar todas las alertas</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">2</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Centro de Mensajes
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Hola, tu solicitud de día libre ha sido aprobada para el próximo viernes.</div>
                                    <div class="small text-gray-500">Recursos Humanos · Hace 2 días</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Leer todos los mensajes</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                            @if(auth()->user()->gender == 'mujer')
                                <img class="img-profile rounded-circle user-profile-img" src="https://i.pinimg.com/474x/6d/5e/38/6d5e38d19bf4c0c9554b1e6beab75952.jpg">
                            @else
                                <img class="img-profile rounded-circle user-profile-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKYRbTui6o8jHIqLFc3hpN-4ItYVRSV5j-8hSTTKLzjVg1tHWTa2__5bmp25TA56gFXhQ&usqp=CAU">
                            @endif
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Configuración
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Registro de Actividad
                            </a>
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Cerrar Sesión
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Panel de Control</h1>
                    <div class="d-flex">
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Welcome Card -->
                    <div class="col-xl-12 mb-4">
                        <div class="card welcome-card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Bienvenido de nuevo, {{ auth()->user()->name }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Aquí tienes un resumen de tu actividad reciente</div>
                                        <p class="mt-2 mb-0">Tu próximo turno comienza hoy a las 09:00 AM</p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card border-left-primary h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Horas trabajadas (mes)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">120</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon-bg">
                                            <i class="fas fa-clock text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card border-left-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Salario estimado (mes)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$2,500</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon-bg">
                                            <i class="fas fa-dollar-sign text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card border-left-info h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Días de vacaciones</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">12</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon-bg">
                                            <i class="fas fa-umbrella-beach text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card border-left-warning h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pendientes</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon-bg">
                                            <i class="fas fa-comments text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Quick Actions -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Acciones Rápidas</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <a href="{{ route('empleado.asistencias.index') }}" class="btn btn-primary btn-block quick-action-btn">
                                            <i class="fas fa-clock fa-2x mb-2"></i>
                                            <h6>Registrar Asistencia</h6>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <a href="{{ route('empleado.justificaciones.index') }}" class="btn btn-warning btn-block quick-action-btn">
                                            <i class="fas fa-envelope fa-2x mb-2"></i>
                                            <h6>Solicitar Justificación</h6>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <a href="{{ route('empleado.dias-descanso.index') }}" class="btn btn-info btn-block quick-action-btn">
                                            <i class="fas fa-bed fa-2x mb-2"></i>
                                            <h6>Días de Descanso</h6>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <a href="{{ route('empleado.nominas.index') }}" class="btn btn-success btn-block quick-action-btn">
                                            <i class="fas fa-file-invoice-dollar fa-2x mb-2"></i>
                                            <h6>Ver Nómina</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Actividad Reciente</h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-icon bg-success">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6>Asistencia registrada</h6>
                                            <p>Hoy a las 08:45 AM</p>
                                            <span class="badge badge-success">Completado</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-icon bg-info">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6>Justificación aprobada</h6>
                                            <p>Ayer a las 03:20 PM</p>
                                            <span class="badge badge-info">Procesado</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-icon bg-warning">
                                            <i class="fas fa-exclamation"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6>Nómina disponible</h6>
                                            <p>5 de Diciembre, 2023</p>
                                            <span class="badge badge-warning">Pendiente revisión</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-light btn-block mt-3">Ver toda la actividad</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Funcionalidades Principales</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 mb-4">
                                        <div class="feature-card h-100">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="feature-icon">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                                <h5 class="mb-0">Gestión de Horarios</h5>
                                            </div>
                                            <p>Consulta y gestiona tus turnos laborales, solicita cambios y revisa tu calendario personalizado.</p>
                                            <a href="{{ route('empleado.horarios.index') }}" class="btn btn-sm btn-outline-primary">Acceder</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="feature-card h-100">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="feature-icon">
                                                    <i class="fas fa-file-invoice-dollar"></i>
                                                </div>
                                                <h5 class="mb-0">Control de Nóminas</h5>
                                            </div>
                                            <p>Accede a tus recibos de pago históricos, descarga comprobantes y consulta desgloses de salarios.</p>
                                            <a href="{{ route('empleado.nominas.index') }}" class="btn btn-sm btn-outline-primary">Acceder</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="feature-card h-100">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="feature-icon">
                                                    <i class="fas fa-user-cog"></i>
                                                </div>
                                                <h5 class="mb-0">Autogestión</h5>
                                            </div>
                                            <p>Actualiza tus datos personales, cambia tu contraseña y gestiona tus preferencias de cuenta.</p>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Acceder</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; NominaApp {{ now()->year }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('theme/js/sb-admin-2.min.js') }}"></script>

<!-- Custom Scripts -->
<script>
    $(document).ready(function() {
        // Activar tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Animar cards al cargar
        $('.card').each(function(i) {
            $(this).delay(100 * i).animate({
                opacity: 1,
                marginTop: 0
            }, 200);
        });

        // Actualizar la hora cada minuto
        function updateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            $('.current-time').text(now.toLocaleTimeString('es-ES', options));
        }

        updateTime();
        setInterval(updateTime, 60000);

        // Notificación de bienvenida
        setTimeout(function() {
            toastr.success('Bienvenido de nuevo, {{ auth()->user()->name }}!', 'Sistema de Nómina');
        }, 1000);
    });
</script>
</body>

</html>
