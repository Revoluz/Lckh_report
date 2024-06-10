<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-DOK Kepegawaian Kemenag Bantul</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/kementrian2.png') }}" >

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}" />
    {{-- @vite([]) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    @yield('head')
    <!-- Toastr CSS and JS CDN -->
</head>
<!--
`body` tag options:

 Apply one or more of the following classes to to the body tag
 to get the desired effect

 * sidebar-collapse
 * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @if (session('success'))
            <script>
                $(document).ready(function() {
                    // Notifikasi toastr berhasil
                    toastr.success('{{ session('success') }}', 'success');
                });
            </script>
        @elseif (session('error'))
            <script>
                $(document).ready(function() {
                    // Notifikasi toastr berhasil
                    toastr.error('{{ session('error') }}', 'gagal');
                });
            </script>
        @endif
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">Home</a>
                </li>
            </ul>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger btn-block mr-2"><b>Logout</b></button>
                {{-- <a href="" class="btn btn-primary btn-block"><b>Logout</b></a> --}}
            </form>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023
                <a href="">e-Dok Kepegawaian</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
    <script src="{{ asset('button-submit.js') }}"></script>
    @yield('plugins')

</body>

</html>
