<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration Venus</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'plugins/summernote/summernote-bs4.min.css') }}">
    <!-- lien du datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- lien css de gestion de stock -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_PATH', ''). 'dist/css/gestion.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center"> -->
        {{-- <!-- <img class="animation__shake" src="{{ asset(env('ASSET_PATH', ''). 'dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="300" width="300"> --> --}}
        <!-- <h1>&#128515;</h1>
        </div> -->
        <!-- Navbar -->

        <!-- /.navbar -->
        @include('partials.header')
        <!-- Main Sidebar Container -->
        @include('partials.sidebar')
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        @include('partials.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/chart.js/Chart.min.js"') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset(env('ASSET_PATH', ''). 'dist/js/pages/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="{{ asset(env('ASSET_PATH', ''). 'dist/js/gestion.js') }}"></script>

    <!-- code pour faire disparaitre le message après 5 seconde -->
    <script>
        const alertElement = document.querySelector('.alert');
        if (alertElement) {
            setTimeout(() => {
                alertElement.style.display = 'none';
            }, 5000);
        }
    </script>
    <!--fin-->

</body>

</html>
