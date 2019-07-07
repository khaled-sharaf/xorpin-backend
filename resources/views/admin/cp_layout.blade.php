<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <title></title> --}}

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

    <!-- Main content -->
    <div id="app" class="wrapper-app-vue"></div>
    <!-- /.content -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<script>
    // set auth user in object global in all file js
    window.user = @json(auth()->user());
</script>

<!-- REQUIRED SCRIPTS -->

{!! Html::script('admin/js/app.js') !!}

<!-- Bootstrap -->
{{-- {!! Html::script('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') !!} --}}
<!-- overlayScrollbars -->
{!! Html::script('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}
<!-- AdminLTE App -->
{!! Html::script('adminlte/dist/js/adminlte.js') !!}



@stack('js')


</body>
</html>
