<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - Sistema de Nómina</title>

    <!-- Tailwind CSS (si lo quieres usar para algo específico) -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">

    <!-- Estilos del Dashboard SB Admin 2 -->
    <link href="{{ asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template (Opcional, si tienes estilos personalizados) -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>

<body id="page-top" class="bg-gradient-primary"> <!-- Todo el contorno azul -->

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar (Opcional, si quieres incluir el sidebar aquí) -->
    <!-- Puedes incluir el contenido del sidebar de admin.index aquí -->
    <!-- O dejarlo vacío si no quieres que aparezca en todas las páginas -->

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

                    @if(!auth()->check())
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('login.index') }}">Entrar</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('register.index') }}">Registrar</a>
                        </li>
                    @else
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                     src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_400,h_400/https:/appsdejoseluis.com/wp-content/uploads/2020/04/face_co.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2024</span>
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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Selecciona "Salir" abajo si estás listo para terminar tu sesión actual.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();
                   window.location.href = '{{ url('/') }}';">Salir</a>
            </div>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('theme/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins (Opcional, si usas algún plugin de SB Admin) -->
<script src="{{ asset('theme/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts (Opcional, si usas algún script personalizado) -->
<script src="{{ asset('theme/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('theme/js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>
