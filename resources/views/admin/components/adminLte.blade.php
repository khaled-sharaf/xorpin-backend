<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- Font Awesome Icons -->
  {!! Html::style('adminlte/plugins/fontawesome-free/css/all.min.css') !!}
  <!-- overlayScrollbars -->
  {!! Html::style('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}
  <!-- Theme style -->
  {!! Html::style('adminlte/dist/css/adminlte.min.css') !!}
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  {!! Html::style('admin/css/app.css') !!}
  @yield('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.layouts.adminLteNavbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.layouts.adminLteSideBar')
  <!-- ./Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">@yield('titleHeader')</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div id="app" class="wrapper-app-vue"></div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
{!! Html::script('adminlte/plugins/jquery/jquery.min.js') !!}
<!-- Bootstrap -->
{!! Html::script('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
<!-- overlayScrollbars -->
{!! Html::script('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}
<!-- AdminLTE App -->
{!! Html::script('adminlte/dist/js/adminlte.js') !!}

{!! Html::script('admin/js/app.js') !!}
@stack('js')


</body>
</html>
