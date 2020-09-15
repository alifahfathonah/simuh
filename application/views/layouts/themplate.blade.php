<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIMUH</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>node_modules/sweetalert2/dist/sweetalert2.min.css">
  @yield('css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?= base_url() ?>dist/img/logo.jpeg" class="img-reponsive"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIMUH</b>_ibs</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="#">Selamat datang &nbsp; <b>Admin</b></a>
          </li>
          <li>
            <a href="">Logout &nbsp;&nbsp;<i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="<?= base_url() ?>dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-file-text-o"></i> <span>Pendaftaran Umroh</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-file-text-o"></i> <span>Pendaftaran Haji</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-check-square-o"></i> <span>Approval</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-suitcase"></i> <span>Paket Umroh/Haji</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-refresh"></i> <span>Transaksi</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-plane"></i> <span>Jadwal keberangkatan</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Transaksi</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Keberangkatan</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Kepulangan</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Peserta Umroh</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Peserta Haji</a></li>
          </ul>
        </li>
        <li>
          <a href="">
            <i class="fa fa-gears"></i> <span>Pengaturan</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.0.1 Build
    </div>
    <strong>Copyright &copy; 2020-2021 <a href="<?= base_url() ?>">ibs Tour and Travel</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url() ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 
<!-- Slimscroll -->
<script src="<?= base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>dist/js/demo.js"></script>

<script src="<?= base_url() ?>node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

@yield('js')

@yield('script')
</body>
</html>