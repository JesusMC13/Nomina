<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrador - Dashboard</title>
    <link href="{{ asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6c5ce7;
            --primary-light: #a29bfe;
            --secondary: #00cec9;
            --dark: #2d3436;
            --light: #f5f6fa;
            --accent: #fd79a8;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fc;
        }

        /* Sidebar Glassmorphism */
        .sidebar {
            background: rgba(30, 30, 60, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            background: rgba(255, 255, 255, 0.1);
            margin: 15px;
            border-radius: 12px;
            padding: 15px 0;
            transition: all 0.4s ease;
        }

        .sidebar-brand:hover {
            transform: translateY(-3px);
            background: rgba(108, 92, 231, 0.3);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
        }

        .sidebar-brand-icon {
            color: var(--accent);
            font-size: 1.5rem;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        .sidebar-brand-text {
            font-weight: 700;
            letter-spacing: 1px;
            color: white;
            font-size: 1.1rem;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .nav-item {
            margin: 8px 15px;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .nav-item:hover {
            transform: translateX(5px);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 3px 6px rgba(0,0,0,0.16);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            padding: 12px 20px;
            position: relative;
            transition: all 0.3s;
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            color: var(--primary-light);
            transition: all 0.3s;
        }

        .nav-item:hover .nav-link {
            color: white;
        }

        .nav-item:hover .nav-link i {
            color: var(--accent);
            transform: scale(1.1);
        }

        .nav-item.active {
            background: rgba(108, 92, 231, 0.3);
            box-shadow: inset 3px 0 0 var(--accent);
        }

        .nav-item.active .nav-link {
            color: white;
        }

        .dropdown-menu {
            background: rgba(45, 52, 54, 0.95);
            backdrop-filter: blur(5px);
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            transition: all 0.3s;
            position: relative;
        }

        .dropdown-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--accent);
            transform: scaleY(0);
            transition: transform 0.3s;
        }

        .dropdown-item:hover {
            color: white;
            background: rgba(108, 92, 231, 0.3);
            padding-left: 25px;
        }

        .dropdown-item:hover::before {
            transform: scaleY(1);
        }

        /* Topbar Gradient */
        .topbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            height: 70px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .topbar::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.1),
                rgba(255, 255, 255, 0),
                rgba(255, 255, 255, 0.1)
            );
            transform: rotate(30deg);
            animation: shine 8s infinite linear;
        }

        /* User Profile */
        .img-profile {
            width: 40px;
            height: 40px;
            border: 2px solid white;
            box-shadow: 0 0 0 2px var(--accent);
            transition: all 0.3s;
        }

        .img-profile:hover {
            transform: scale(1.1);
            box-shadow: 0 0 0 3px var(--accent), 0 0 20px rgba(253, 121, 168, 0.5);
        }

        /* Dashboard Content */
        .dashboard-header {
            border-bottom: 2px solid var(--primary);
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 50px;
            height: 4px;
            background: var(--accent);
        }

        /* Cards */
        .info-card {
            border: none;
            border-radius: 15px;
            padding: 25px;
            transition: all 0.4s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(108, 92, 231, 0.1);
        }

        .info-card .icon {
            font-size: 2.5rem;
            opacity: 0.2;
            position: absolute;
            right: 20px;
            top: 20px;
            transition: all 0.3s;
        }

        .info-card:hover .icon {
            opacity: 0.3;
            transform: scale(1.1);
        }

        /* Floating Animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar - Manteniendo tus rutas exactamente como las tenías -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
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

            <!-- Main Content - Manteniendo tu estructura pero con mejor estilo -->
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800 dashboard-header">Panel de Control</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Empleados Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="info-card">
                            <div class="icon text-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-primary">42</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Empleados Activos</div>
                        </div>
                    </div>

                    <!-- Asistencias Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="info-card">
                            <div class="icon text-success">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-success">92%</div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Asistencia Hoy</div>
                        </div>
                    </div>

                    <!-- Retardos Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="info-card">
                            <div class="icon text-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-warning">5</div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Retardos Hoy</div>
                        </div>
                    </div>

                    <!-- Reportes Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="info-card">
                            <div class="icon text-info">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-info">15</div>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Reportes Generados</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Acciones Rápidas</h6>
                            </div>
                            <div class="card-body text-center">
                                <a href="{{ route('adminn.empleados.index') }}" class="btn btn-primary btn-icon-split mx-2 mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-users"></i>
                                        </span>
                                    <span class="text">Empleados</span>
                                </a>
                                <a href="{{ route('adminn.asistencias.index') }}" class="btn btn-success btn-icon-split mx-2 mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-calendar-check"></i>
                                        </span>
                                    <span class="text">Asistencias</span>
                                </a>
                                <a href="{{ route('adminn.reportes.index') }}" class="btn btn-info btn-icon-split mx-2 mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </span>
                                    <span class="text">Reportes</span>
                                </a>
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
<script>
    // Efecto de iluminación al pasar el mouse por los elementos del menú
    $(document).ready(function() {
        $('.nav-item').hover(
            function() {
                $(this).find('.nav-link i').css('text-shadow', '0 0 10px rgba(253, 121, 168, 0.7)');
            },
            function() {
                $(this).find('.nav-link i').css('text-shadow', 'none');
            }
        );

        // Efecto de onda en el sidebar
        $('.sidebar').mousemove(function(e) {
            const x = e.pageX - $(this).offset().left;
            const y = e.pageY - $(this).offset().top;

            $(this).css('background',
                `radial-gradient(circle at ${x}px ${y}px, rgba(108, 92, 231, 0.3), rgba(30, 30, 60, 0.85))`);
        });
    });
</script>
</body>
</html>
