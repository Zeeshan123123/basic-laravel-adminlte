<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }} @hasSection('name') | @yield('page_title') @endif</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ASSETS_BACKEND}}plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ASSETS_BACKEND}}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ASSETS_BACKEND}}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ASSETS_BACKEND}}plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ASSETS_BACKEND}}dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ASSETS_BACKEND}}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ASSETS_BACKEND}}plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ASSETS_BACKEND}}plugins/summernote/summernote-bs4.min.css">

  <!-- Page Styles -->
  @yield('page_styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @if(auth()->user())
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ASSETS_BACKEND}}dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('common.backend.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('common.backend.sidebar')
  @endif

  <!-- Content Wrapper. Contains page content -->
  @yield('page_content')
  <!-- /.content-wrapper -->

  @if(auth()->user())
    <!-- Footer -->
    @include('common.backend.footer')
  @endif

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ASSETS_BACKEND}}plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ASSETS_BACKEND}}plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ASSETS_BACKEND}}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ASSETS_BACKEND}}plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ASSETS_BACKEND}}plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ASSETS_BACKEND}}plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ASSETS_BACKEND}}plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ASSETS_BACKEND}}plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ASSETS_BACKEND}}plugins/moment/moment.min.js"></script>
<script src="{{ASSETS_BACKEND}}plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ASSETS_BACKEND}}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ASSETS_BACKEND}}plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ASSETS_BACKEND}}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ASSETS_BACKEND}}dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes 
<script src="{{ASSETS_BACKEND}}dist/js/demo.js"></script>
-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="{{ASSETS_BACKEND}}dist/js/pages/dashboard.js"></script>
-->


<script>
$('.nav-item').on('click',function(){
  if($('.nav-item').hasClass('menu-open')){
    $('.nav-item').removeClass('menu-open');
  }
});
</script>

<!-- Page Scripts -->
@yield('page_scripts')
</body>
</html>
