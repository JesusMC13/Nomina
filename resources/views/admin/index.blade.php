<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrador - Dashboard</title>
    <link href="{{ asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Administrador</div>
            </a>
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading">Gestión de Nómina</div>
            <li class="nav-item">
                <a class="nav-link" href="turnos.html">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Turnos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dias-descanso.html">
                    <i class="fas fa-bed"></i>
                    <span>Días de Descanso</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="horas-extras.html">
                    <i class="fas fa-clock"></i>
                    <span>Horas Extras</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="descuentos.html">
                    <i class="fas fa-percentage"></i>
                    <span>Descuentos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reportes.html">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Reportes de Nómina</span>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Uriel</span>
                                <img class="img-profile rounded-circle" src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_400,h_400/https:/appsdejoseluis.com/wp-content/uploads/2020/04/face_co.png">
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>

                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Panel de Control</h1>
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