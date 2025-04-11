<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cortex - Dashboard</title>

    <!-- Stilled -->
    
    
    <link href="{{ asset('assets/admin/assets/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/admin/assets/js/all.js') }}" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for tables -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        .obrigatorio {
            color: red;
        }

        .nav-link {
            color: red;
        }

        .error {
            color: red;
            font-size: 0.90rem;
            width: 100%;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('etoro-logo.png') }}">

    <link href="{{ asset('assets/toastr/toastr.min.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css') }}">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.admin.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.admin.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content');
                <!-- /.container-fluid -->



            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Deseja Terminar a sessão?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> Clique em "Sair" se quiser terminar a sessão</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <form id="logout-form" action="{{ route('auth.signOut') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary type="submit">Sair</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <!-- Stilled -->
    {{-- <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script> --}}
    <script src="{{ asset('assets/admin/assets/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/Chart.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/demo/chart-bar-demo.js') }}"></script>
    
    <script src="{{ asset('assets/js/validate/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/js/validate/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/validate/messages_pt_PT.js') }}"></script>

    <script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        toastr.options = {
            closeButton: true, // Exibe o botão de fechar
            timeOut: 5000, // Define o tempo de exibição (0 = permanente)
            extendedTimeOut: 3000, // Define o tempo adicional ao passar o mouse (0 = permanente)
            progressBar: true, // Exibe uma barra de progresso
            positionClass: 'toast-top-right' // Define a posição do alerta na tela
        };

        function msgToastrInfo(msg) {
            toastr.info(msg, 'Sucesso');
        }

        function msgToastrSuccess(msg) {
            toastr.success(msg, 'Sucesso');
        }

        function msgToastrWarning(msg) {
            toastr.warning(msg, 'Aviso');
        }

        function msgToastrError(msg) {
            toastr.error(msg, 'Erro');
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                msgToastrSuccess('{{ session('success') }}');
            @elseif (session('warning'))
                msgToastrWarning('{{ session('warning') }}');
            @elseif (session('error'))
                msgToastrError('{{ session('error') }}');
            @endif
        });

        const sucessMessage = sessionStorage.getItem('sucessMessage');
        if (sucessMessage) {
            msgToastrSuccess(sucessMessage);
            sessionStorage.removeItem('sucessMessage');
        }
        /*msgToastrInfo("1");
        msgToastrSuccess("2");
        msgToastrWarning("3");
        msgToastrError("4");*/
    </script>

    @yield('script')


</body>

</html>
